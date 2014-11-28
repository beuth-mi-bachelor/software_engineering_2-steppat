<?php

require_once __DIR__ . "/../entities/User.php";
require_once __DIR__ . "/../entities/Contest.php";
require_once __DIR__ . "/../entities/Idea.php";

/**
 * Klasse für den Datenzugriff
 */
class Model {

    public static $DB_HOST = 'localhost';
    public static $DB_NAME = 'se';
    public static $DB_USER = 'se_ii';
    public static $DB_PASSWORD = 'AMPDynamics';

    public static $currentViewContent = [];
    public static $contests = [];
    public static $ideas = [];

    public static function openDatabase() {
        $link = mysql_connect(self::$DB_HOST, self::$DB_USER, self::$DB_PASSWORD);
        if (!$link) {
            die("Kein Server gefunden");
        }
        mysql_select_db(self::$DB_NAME, $link) or die("Datenbank nicht gefunden");
        return $link;
    }

    /**
     * Login eines Users
     */
    public static function login($username, $password) {

        global $entityManager;

        $userRepo = $entityManager->getRepository('User');
        $password = md5($password);
        $findUser = $userRepo->findBy(array('username' => $username),array(), 1);

        if (sizeof($findUser) == 1) {
            $user = $findUser[0];
            if ($user instanceof User) {
                if ($user->getPassword() == $password) {
                    $_SESSION["username"] = $username;
                    $_SESSION["user-id"] = $user->getId();
                    return true;
                }
            }
        }
        return false;
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

        $password = md5($password);

        $findUser = $userRepo->findBy( array('username' => $username));

        if (sizeof($findUser) == 0 && sizeof(Controller::$registerError) == 0) {
            $newUser = new User();
            $newUser->setUsername($username);
            $newUser->setPassword($password);
            $newUser->setEmail($email);

            try {
                $entityManager->persist($newUser);
                $entityManager->flush();
            } catch (Doctrine\DBAL\DBALException $e) {
                return false;
            }
            return true;

        } else {
            array_push(Controller::$registerError, "Der Username '".$username."' ist bereits vorhanden");
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
        $allEntries = $contestRepo ->findAll();

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

    /**
     * Gibt einen bestimmten Wettbewerbs-Eintrag zurück.
     * @param int $id Id des gesuchten Wettbewerb-Eintrags
     * @return Array Array, dass einen Eintrag repräsentiert, bzw. wenn dieser nicht vorhanden ist, null.
     */
    public static function getContest($id) {
        global $entityManager;

        $contestRepo = $entityManager->getRepository('Contest');
        $entry = $contestRepo ->find($id);

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
        $allEntries = $ideaRepo ->findBy(array('contest_id' => $contestId));

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
        $entry = $contestRepo ->find($ideaId);

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
}

?>