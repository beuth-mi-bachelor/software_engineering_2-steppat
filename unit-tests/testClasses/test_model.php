<?php



/**
 * Klasse für den Datenzugriff
 */
class TestModel {

    public static $currentViewContent = [];
    public static $contests = [];
    public static $ideas = [];

    /**
     * Login eines Users
     */
    public static function login($user, $username, $password) {

            if ($user instanceof User) {
                if (TestModel::checkPassword($user, $password)) {
                    $_SESSION["username"] = $username;
                    $_SESSION["user-id"] = $user->getId();
                    return true;
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


        if ($password != $password2) {
            return false;
        }
        if ($username == "") {
            return false;
        }
        if ($email == "") {
            return false;
        }
        if ($password == "") {
            return false;
        }

        $salt = TestModel::generateSalt();
        $password = TestModel::hashPassword($password, $salt);

        $newUser = new User();
        $newUser->setUsername($username);
        $newUser->setRoleId(0);
        $newUser->setPassword($password);
        $newUser->setEmail($email);
        $newUser->setHash($salt);
        return $newUser;

    }

}

?>