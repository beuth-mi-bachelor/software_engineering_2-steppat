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
        $entries = array(array("id", "contest_id", "user_id", "name", "descripton", "image_url"));
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
     * @param $nr
     * @param $name
     * @param $preis
     */
    public static function appendEntry($contest_id, $user_id, $name, $descripton, $image_url){
        $link = self::openDatabase();
        $sql = "INSERT INTO $DB_NAME.`idea` (`id`, `contest_id`, `user_id`, `name`, `descripton`, `image_url`)
                VALUES (NULL , '$contest_id', '$user_id', '$name', '$descripton', '$image_url');";
        mysql_query($sql);
        mysql_close($link);
	}
}
?>