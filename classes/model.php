<?php

/**
 * Klasse für den Datenzugriff
 */
class Model {

    // TODO: Implement functions for contest, Login, Register

    private static $DB_HOST = 'localhost';
    private static $DB_NAME = 'se';
    private static $DB_USER = 'se_ii';
    private static $DB_PASSWORD = 'AMPDynamics';

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

        $link = self::openDatabase();
        $password = md5($password);

        $sql = "SELECT username, password FROM User WHERE username LIKE '$username' LIMIT 1";
        $result = mysql_query($sql);

        $row = mysql_fetch_object($result);

        if ($row) {
            if ($row->password == $password) {
                $_SESSION["username"] = $username;
                mysql_close($link);
                return true;
            }
        }

        mysql_close($link);
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
        $link = self::openDatabase();

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

        if (sizeof(Controller::$registerError) != 0) {
            return false;
        }

        $password = md5($password);

        $result = mysql_query("SELECT id FROM User WHERE username LIKE '$username'");
        $num = mysql_num_rows($result);

        if ($num == 0) {
            $entry = "INSERT INTO User (username, password, email) VALUES ('$username', '$password', '$email')";
            $resultEntry = mysql_query($entry);

            if ($resultEntry) {
                mysql_close($link);
                return true;
            } else {
                mysql_close($link);
                return false;
            }
        } else {
            array_push(Controller::$registerError, "Der Username '".$username."' ist bereits vorhanden");
            mysql_close($link);
            return false;
        }

    }

    /**
     * Gibt alle Wettbewerbs-Einträge zurück.
     * @return Array Array von Wettbewerbseinträgen.
     */
    public static function getContests() {
        $link = self::openDatabase();
        $sql = "SELECT * FROM Contest";
        $result = mysql_query($sql);
        if (!$result) {
            echo mysql_error();
        }
        $entries = array(array("id", "description", "name", "starts_at", "ends_at", "image_url"));
        // Alle Zeilen auslesen und in das Array $entries schreiben:
        while ($row = mysql_fetch_array($result)) {
            $entries[] = $row;
        }
        // erste Zeile entfernen
        unset($entries[0]);

        mysql_close($link);
        return $entries;
    }

    /**
     * Gibt einen bestimmten Wettbewerbs-Eintrag zurück.
     * @param int $id Id des gesuchten Wettbewerb-Eintrags
     * @return Array Array, dass einen Eintrag repräsentiert, bzw. wenn dieser nicht vorhanden ist, null.
     */
    public static function getContest($id) {
        $link = self::openDatabase();
        $sql = "SELECT * FROM Contest WHERE id=$id";
        $result = mysql_query($sql);
        if (!$result) {
            echo mysql_error();
        }
        $entry = array(array("id", "description", "name", "starts_at", "ends_at", "image_url"));
        while ($row = mysql_fetch_array($result)) {
            $entry[] = $row;
        }
        // erste Zeile entfernen
        unset($entry[0]);
        mysql_close($link);
        return $entry[1];
    }

    public static function addContest($name, $description, $image_url, $starts_at, $ends_at) {
        $link = self::openDatabase();
        $sql = "INSERT INTO Contest (`description`, `name`, `starts_at`, `ends_at`, `image_url`) VALUES ('$description', '$name', '$starts_at', '$ends_at', '$image_url');";
        $result = mysql_query($sql);
        if (!$result) {
            echo mysql_error();
        }
        $entry = array("id", "description", "name", "starts_at", "ends_at", "image_url");
        mysql_close($link);
    }

    public static function getIdeaByContest($contestId) {
        $link = self::openDatabase();
        $sql = "SELECT * FROM Idea WHERE contest_id=$contestId";
        $result = mysql_query($sql);
        if (!$result) {
            echo mysql_error();
        }
        $entries = array(array("id", "user_id", "name", "description", "image_url", "contest_id"));
        while ($row = mysql_fetch_array($result)) {
            $entries[] = $row;
        }
        // erste Zeile entfernen
        unset($entries[0]);
        mysql_close($link);
        return $entries;
    }
}

?>