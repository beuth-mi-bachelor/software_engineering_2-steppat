<?php

require_once __DIR__ . "/../entities/User.php";
require_once __DIR__ . "/../entities/Contest.php";
require_once __DIR__ . "/../entities/Idea.php";
require_once __DIR__ . "/../entities/Comment.php";

/**
 * Klasse für den Datenzugriff
 */
class Model {

    public static $currentViewContent = [];
    public static $contests = [];
    public static $ideas = [];

    /**
     * Login eines Users
     */
    public static function login($username, $password) {

        global $entityManager;

        $userRepo = $entityManager->getRepository('User');
        $findUser = $userRepo->findBy(array('username' => $username), array(), 1);

        if (sizeof($findUser) == 1) {
            $user = $findUser[0];
            if ($user instanceof User) {
                if (Model::checkPassword($user, $password)) {
                    $_SESSION["username"] = $username;
                    $_SESSION["user-id"] = $user->getId();
                    return true;
                }
            }
        }
        return false;
    }

    public static function checkPassword($user, $password) {
        if(!function_exists('hash_equals')) {

            function hash_equals($str1, $str2) {
                if(strlen($str1) != strlen($str2)) {
                    return false;
                } else {
                    $res = $str1 ^ $str2;
                    $ret = 0;
                    for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
                    return !$ret;
                }
            }
        }

        if ($user instanceof User) {
            $salt = sprintf("$2a$%02d$", 10) . $user->getHash();

            if ( hash_equals($user->getPassword(), crypt($password, $salt)) ) {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    public static function hashPassword($password, $salt) {

        // A higher "cost" is more secure but consumes more processing power
        $cost = 10;

        // Prefix information about the hash so PHP knows how to verify it later.
        // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
        $salt = sprintf("$2a$%02d$", $cost) . $salt;

        // Hash the password with the salt
        return crypt($password, $salt);

    }

    public static function generateSalt() {
        // Create a random salt
        return strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
    }

    public static function getUsernameById($user_id) {

        global $entityManager;

        $userRepo = $entityManager->getRepository('User');
        $findUser = $userRepo->find($user_id);

        if (sizeof($findUser) == 1) {
            if ($findUser instanceof User) {
                return $findUser->getUsername();
            }
        }
        return null;
    }

    public static function isLoggedIn() {
        if (isset($_SESSION["username"])) {
            return true;
        }
        return false;
    }

    /**
     * Registrieren eines Users
     */
    public static function register($username, $email, $password, $password2) {

        global $entityManager;

        $userRepo = $entityManager->getRepository('User');

        Controller::$registerError = [];

        if ($password != $password2) {
            array_push(Controller::$registerError, "Die Passwörter stimmen nicht überein!");
        }
        if ($username == "") {
            array_push(Controller::$registerError, "Ihr Username darf nicht leer sein!");
        }
        if ($email == "") {
            array_push(Controller::$registerError, "Ihre E-Mail-Adresse darf nicht leer sein!");
        }
        if ($password == "") {
            array_push(Controller::$registerError, "Das Passwort darf nicht leer sein!");
        }



        $findUser = $userRepo->findBy(array('username' => $username));

        if (sizeof($findUser) == 0 && sizeof(Controller::$registerError) == 0) {

            $salt = Model::generateSalt();
            $password = Model::hashPassword($password, $salt);

            $newUser = new User();
            $newUser->setUsername($username);
            $newUser->setPassword($password);
            $newUser->setEmail($email);
            $newUser->setHash($salt);

            try {
                $entityManager->persist($newUser);
                $entityManager->flush();
            } catch (Doctrine\DBAL\DBALException $e) {
                return false;
            }
            return true;

        } else {
            array_push(Controller::$registerError, "Der Username '" . $username . "' ist bereits vorhanden");
            return false;
        }

    }

    /**
     * Gibt alle Wettbewerbs-Einträge zurück.
     * @return Array Array von Wettbewerbseinträgen.
     */
    public static function getContests() {

        global $entityManager;

        $contestRepo = $entityManager->getRepository('Contest');
        $allEntries = $contestRepo->findAll();

        $entries = array();

        // Alle Zeilen auslesen und in das Array $entries schreiben:
        foreach ($allEntries as $row) {
            if ($row instanceof Contest) {
                $entries[] = array(
                    "id" => $row->getId(),
                    "description" => $row->getDescription(),
                    "name" => $row->getName(),
                    "starts_at" => date_format($row->getStartsAt(), 'd.m.Y H:i'),
                    "ends_at" => date_format($row->getEndsAt(), 'd.m.Y H:i'),
                    "image_url" => $row->getImageUrl()
                );
            }
        }

        return $entries;
    }

    public static function searchContest($name) {

        global $entityManager;

        $contestRepo = $entityManager->getRepository('Contest');
        $allEntries = $contestRepo->findBy(array('name' => $name));

        $entries = array();

        // Alle Zeilen auslesen und in das Array $entries schreiben:
        foreach ($allEntries as $entry) {
            if ($entry instanceof Contest) {
                $entries[] = array(
                    "id" => $entry->getId(),
                    "description" => $entry->getDescription(),
                    "name" => $entry->getName(),
                    "starts_at" => date_format($entry->getStartsAt(), 'd.m.Y H:i'),
                    "ends_at" => date_format($entry->getEndsAt(), 'd.m.Y H:i'),
                    "image_url" => $entry->getImageUrl()
                );
            }
        }
        return $entries;
    }


    /**
     * Gibt einen bestimmten Wettbewerbs-Eintrag zurück.
     * @param int $id Id des gesuchten Wettbewerb-Eintrags
     * @return Array Array, dass einen Eintrag repräsentiert, bzw. wenn dieser nicht vorhanden ist, null.
     */
    public static function getContest($id) {
        global $entityManager;

        $contestRepo = $entityManager->getRepository('Contest');
        $entry = $contestRepo->find($id);

        if (isset($entry) && $entry instanceof Contest) {
            return array(
                "id" => $entry->getId(),
                "description" => $entry->getDescription(),
                "name" => $entry->getName(),
                "starts_at" => date_format($entry->getStartsAt(), 'd.m.Y H:i'),
                "ends_at" => date_format($entry->getEndsAt(), 'd.m.Y H:i'),
                "image_url" => $entry->getImageUrl()
            );
        }
        return null;

    }

    public static function searchIdea($name) {

        global $entityManager;

        $ideaRepo = $entityManager->getRepository('Idea');
        $allEntries = $ideaRepo->findBy(array('name' => $name));

        $entries = array();

        // Alle Zeilen auslesen und in das Array $entries schreiben:
        foreach ($allEntries as $entry) {
            if ($entry instanceof Idea) {
                $entries[] = array(
                    "id" => $entry->getId(),
                    "description" => $entry->getDescription(),
                    "name" => $entry->getName(),
                    "contest_id" => $entry->getContestId(),
                    "user_id" => $entry->getUserId(),
                    "image_url" => $entry->getImageUrl()
                );
            }
        }
        return $entries;
    }

    public static function addContest($name, $description, $image_url, $starts_at, $ends_at) {

        global $entityManager;

        $contest = new Contest();
        $contest->setDescription($description);
        $contest->setEndsAt(new DateTime($ends_at));
        $contest->setImageUrl($image_url);
        $contest->setName($name);
        $contest->setStartsAt(new DateTime($starts_at));
        try {
            $entityManager->persist($contest);
            $entityManager->flush();
        } catch (Doctrine\DBAL\DBALException $e) {
            return false;
        }
        return true;
    }

    public static function updateContest($contestId, $name, $description, $image_url, $starts_at, $ends_at) {

        global $entityManager;

        $contest = new Contest();
        $contest->setId($contestId);
        $contest->setDescription($description);
        $contest->setEndsAt(new DateTime($ends_at));
        $contest->setImageUrl($image_url);
        $contest->setName($name);
        $contest->setStartsAt(new DateTime($starts_at));
        try {
            $entityManager->merge($contest);
            $entityManager->flush();
        } catch (Doctrine\DBAL\DBALException $e) {
            return false;
        }
        return true;
    }

    public static function getIdeaByContest($contestId) {

        global $entityManager;

        $ideaRepo = $entityManager->getRepository('Idea');
        $allEntries = $ideaRepo->findBy(array('contest_id' => $contestId));

        $entries = array();

        // Alle Zeilen auslesen und in das Array $entries schreiben:
        foreach ($allEntries as $entry) {
            if ($entry instanceof Idea) {
                $entries[] = array(
                    "id" => $entry->getId(),
                    "description" => $entry->getDescription(),
                    "name" => $entry->getName(),
                    "contest_id" => $entry->getContestId(),
                    "user_id" => $entry->getUserId(),
                    "image_url" => $entry->getImageUrl()
                );
            }
        }
        return $entries;
    }

    public static function addIdea($name, $description, $image_url, $contestId) {

        global $entityManager;

        $idea = new Idea();
        $idea->setDescription($description);
        $idea->setContestId($contestId);
        $idea->setImageUrl($image_url);
        $idea->setName($name);
        $idea->setUserId($_SESSION["user-id"]);
        try {
            $entityManager->persist($idea);
            $entityManager->flush();
        } catch (Doctrine\DBAL\DBALException $e) {
            return false;
        }
        return true;

    }

    public static function getIdea($ideaId) {

        global $entityManager;

        $contestRepo = $entityManager->getRepository('Idea');
        $entry = $contestRepo->find($ideaId);

        if (isset($entry) && $entry instanceof Idea) {
            return array(
                "id" => $entry->getId(),
                "description" => $entry->getDescription(),
                "name" => $entry->getName(),
                "contest_id" => $entry->getContestId(),
                "user_id" => $entry->getUserId(),
                "image_url" => $entry->getImageUrl()
            );
        }
        return null;

    }

    public static function updateIdea($ideaId, $name, $description, $image_url) {
        global $entityManager;

        $idea = new Idea();
        $idea->setDescription($description);
        $idea->setId($ideaId);
        $idea->setImageUrl($image_url);
        $idea->setName($name);
        $idea->setUserId($_SESSION["user-id"]);
        try {
            $entityManager->merge($idea);
            $entityManager->flush();
        } catch (Doctrine\DBAL\DBALException $e) {
            return false;
        }
        return true;
    }

    public static function addComment($text, $idea_id) {

        global $entityManager;

        $comment = new Comment();
        $comment->setIdeaId($idea_id);
        $comment->setText($text);
        $comment->setUserId($_SESSION["user-id"]);
        try {
            $entityManager->persist($comment);
            $entityManager->flush();
        } catch (Doctrine\DBAL\DBALException $e) {
            return false;
        }
        return true;

    }

    public static function getComments($ideaId) {

        global $entityManager;

        $commentRepo = $entityManager->getRepository('Comment');
        $allEntries = $commentRepo->findBy(array('idea_id' => $ideaId));

        $entries = array();

        // Alle Zeilen auslesen und in das Array $entries schreiben:
        foreach ($allEntries as $entry) {
            if ($entry instanceof Comment) {
                $entries[] = array(
                    "id" => $entry->getId(),
                    "text" => $entry->getText(),
                    "created_at" => $entry->getCreatedAt(),
                    "user_id" => $entry->getUserId(),
                    "idea_id" => $entry->getIdeaId()
                );
            }
        }
        return $entries;
    }
}

?>