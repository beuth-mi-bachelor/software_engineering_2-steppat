<?php
/**
 * Klasse für den Datenzugriff
 */
class Model {

    // TODO: Implement functions for contest, Login, Register

    public $DB_HOST = 'localhost';
    public $DB_NAME = 'se';
    public $DB_USER = 'se_ii';
    public $DB_PASSWORD = 'AMPDynamics';

    private static function openDatabase() {
        $link = mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
        if (!$link) {
            die("Kein Server gefunden");
        }
        //else
        //    echo "Erfolgreiche Serververbindung";
        mysql_select_db($DB_NAME) or die("Datenbank nicht gefunden");
        return $link;
    }
	/**
	 * Gibt alle Ideen-Einträge zurück.
	 * @return Array Array von Blogeinträgen.
	 */
	public static function getIdeas(){
        $link = self::openDatabase();
        $sql = "SELECT * FROM `idea`";
        $result = mysql_query($sql);
        if(!$result)
            echo mysql_error();
        $entries = array(array("id", "contest_id", "user_id", "name", "description", "image_url"));
        // Alle Zeilen auslesen und in das Array $entries schreiben:
        while($row = mysql_fetch_array($result))
            $entries[] = $row;
        // erste Zeile entfernen
        unset($entries[0]);

        mysql_close($link);
        return $entries;
	}

	/**
	 * Gibt einen bestimmten Idee-Eintrag zurück.
	 * @param int $id Id des gesuchten Idee-Eintrags
	 * @return Array Array, dass einen Eintrag repräsentiert, bzw. wenn dieser nicht vorhanden ist, null.
	 */
	public static function getIdea($id){
        $link = self::openDatabase();
        $sql = "SELECT * FROM `idea` WHERE id =$id";
        $entry = mysql_query($sql);
        mysql_close($link);
        return $entry;
	}

    /**
	 * Gibt alle Wettbewerbs-Einträge zurück.
	 * @return Array Array von Wettbewerbseinträgen.
	 */
	public static function getContests(){
        $link = self::openDatabase();
        $sql = "SELECT * FROM `contest`";
        $result = mysql_query($sql);
        if(!$result)
            echo mysql_error();
        $entries = array(array("id", "description", "name", "starts_at", "ends_at", "image_url"));
        // Alle Zeilen auslesen und in das Array $entries schreiben:
        while($row = mysql_fetch_array($result))
            $entries[] = $row;
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
    	public static function getContest($id){
            $link = self::openDatabase();
            $sql = "SELECT * FROM `Contest` WHERE id =$id";
            $entry = mysql_query($sql);
            mysql_close($link);
            return $entry;
    	}
        /**
    	 * Login eines Users
    	 */
    	public function login($username,$password)
        {
            $link = self::openDatabase();
            //$username = $_POST["username"];
            //$password = md5($_POST["password"]);

            $abfrage = "SELECT username, password FROM login WHERE username LIKE '$username' LIMIT 1";
            $ergebnis = mysql_query($abfrage);
            $row = mysql_fetch_object($ergebnis);

            if($row->password == $password)
                {
                $_SESSION["username"] = $username;
                echo "Login erfolgreich. <br> <a href=\"contest-overview.php\">Geschützter Bereich</a>";
                }
            else
                {
                echo "Benutzername und/oder Passwort waren falsch. <a href=\"login.html\"  >Login</a>";
                }
        mysql_close($link);

                }

                /**
                * Registrieren eines Users
                */
        public function register() {
            $link = self::openDatabase();
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $password2 = $_POST["password-repeat"];

            if($password != $password2 OR $username == "" OR $password == "")
                {
                echo "Eingabefehler. Bitte alle Felder korekt ausfüllen. <a href=\"eintragen.html\">Zurück</a>";
                exit;
                }
            $password = md5($password);

            $result = mysql_query("SELECT id FROM User WHERE username LIKE '$username'");
            $menge = mysql_num_rows($result);

            if($menge == 0)
                {
                $eintrag = "INSERT INTO User (username, password, email) VALUES ('$username', '$password', '$email')";
                $eintragen = mysql_query($eintrag);

                if($eintragen == true)
                    {
                    echo "Benutzername <b>$username</b> wurde erstellt. <a href=\"login.html\">Login</a>";
                    }
                else
                    {
                    echo "Fehler beim Speichern des Benutzernames. <a href=\"register.html\">Zurück</a>";
                    }
                }
            else
                {
                echo "Benutzername schon vorhanden. <a href=\"eintragen.html\">Zurück</a>";
                }
            mysql_close($link);

                    }

    /**
     * @param $nr
     * @param $name
     * @param $preis
     */
    public static function appendIdea($contest_id, $user_id, $name, $descripton, $image_url){
        $link = self::openDatabase();
        $sql = "INSERT INTO $DB_NAME.`idea` (`id`, `contest_id`, `user_id`, `name`, `descripton`, `image_url`)
                VALUES (NULL , '$contest_id', '$user_id', '$name', '$descripton', '$image_url');";
        mysql_query($sql);
        mysql_close($link);
	}
	public static function appendContest($contest_id, $user_id, $name, $descripton, $image_url){
            $link = self::openDatabase();
            $sql = "INSERT INTO $DB_NAME.`Contest` (`id`, `description`, `name`, `starts_at`, `ends_at`, `image_url`)
                    VALUES (NULL , '$description', '$name', '$starts_at', '$ends_at', '$image_url');";
            mysql_query($sql);
            mysql_close($link);
    	}
}
?>