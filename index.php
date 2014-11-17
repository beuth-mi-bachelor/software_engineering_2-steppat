<!DOCTYPE HTML>
<html lang="de">
    <head>
        <title>Reha Tool: Login</title>

        <meta charset="utf-8">
        <meta name="description" lang="de" content="Dieses Reha Tool bietet die Möglichkeit Wettbewerbe zu erstellen und Ideen hinzuzufügen. Angemeldete User dürfen eine Idee erstellen zu einem ausgewählten Wettbewerb und andere Beiträge kommentieren">
        <meta name="keywords" lang="de" content="Wettbewerb, Idee, Erstellen, Reha">
        <meta name="author" content="AMP-Dynamics">

        <meta name="viewport" content="width=device-width, user-scalable=yes">
        <meta name="format-detection" content="telephone=no">
        <meta name="robots" content="index,follow,noarchive">

        <link href='css/main.css' rel='stylesheet' type='text/css'>
        <script src="js/lib/jquery-2.1.1.min.js"></script>

    </head>
    <body class="reha-tool">
        <main class="content-wrapper">
            <article class="inner-content-wrapper">
                <img src="http://placehold.it/993x559" alt="Logo" />
                <h2 class="title">Willkommen</h2>
                <form id="form" action="php/functions.php" method="post">
                    <label class="field" id="username">
                        <input class="name-input" type="text" name="username" placeholder="Benutzername">
                    </label>
                    <label class="field" id="password">
                        <input type="password" class="pw-input" name="password" placeholder="Passwort">
                    </label>
                    <button type="submit" class="sub"><span>Anmelden</span></button>
                    <a href="user/register.html" target="_self">Noch keinen Account?</a>
                </form>
            </article>
        </main>
        <script type="text/javascript" src="js/app.js"></script>
    </body>
</html>