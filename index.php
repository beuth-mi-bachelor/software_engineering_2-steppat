<?php
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set("display_errors", 1);
session_start();
?>
<!DOCTYPE HTML>
<html lang="de">
<head>
    <title>Reha Tool: Login</title>

    <meta charset="utf-8">
    <meta name="description" lang="de"
          content="Dieses Reha Tool bietet die Möglichkeit Wettbewerbe zu erstellen und Ideen hinzuzufügen. Angemeldete User dürfen eine Idee erstellen zu einem ausgewählten Wettbewerb und andere Beiträge kommentieren">
    <meta name="keywords" lang="de" content="Wettbewerb, Idee, Erstellen, Reha">
    <meta name="author" content="AMP-Dynamics">

    <meta name="viewport" content="width=device-width, user-scalable=yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="robots" content="index,follow,noarchive">

    <link href='css/main.css' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <script src="js/lib/jquery-2.1.1.min.js" type="text/javascript"></script>

</head>
<body class="reha-tool">

<?php

// Klassen einbinden
require_once('classes/controller.php');
require_once('classes/model.php');
require_once('classes/view.php');

require_once "bootstrap.php";

//getting the EntityManager


// $_GET und $_POST zusammenfassen
$request = array_merge($_GET, $_POST);

?>

<pre>
    <span>Debug-Messages</span>
    <?php var_dump($request); ?>
</pre>

<?php
// Controller erstellen
$controller = new Controller($request);
// Inhalt der Webanwendung ausgeben
echo $controller->display();

?>

<script type="text/javascript" src="js/app.js"></script>
</body>
</html>