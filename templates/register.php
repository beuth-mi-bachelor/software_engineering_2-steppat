<main class="content-wrapper fullscreen">
    <article class="inner-content-wrapper">
        <img src="http://placehold.it/993x559" alt="Logo"/>
        <h2 class="title">Registrieren</h2>
        <?php

            if (Controller::$registerInfo) {
                echo '<em>Sie wurden erfolgreich registriert. Ein Administrator wird Sie demnächst freischalten. Sie erhalten dann umgegehend eine Bestätigungsmail!</em>';
                echo '<a href="index.php?action=login" target="_self">Zum Login</a>';
            } else {
                foreach(Controller::$registerError as $error ) {
                    echo '<em class="error">' . $error . '</em>';
                }
            }
        ?>
        <?php if (!Controller::$registerInfo) : ?>
            <form id="form" action="index.php?action=register" method="post">
                <label class="field" id="username">
                    <input class="name-input" type="text" name="username" placeholder="Benutzername" required>
                </label>
                <label class="field" id="e-mail">
                    <input class="e-mail-input" type="email" name="email" placeholder="E-Mail-Adresse" required>
                </label>
                <label class="field" id="password">
                    <input type="password" class="pw-input" name="password" placeholder="Passwort" required>
                    <input type="password" class="pw-input-repeat" name="password-repeat" placeholder="Passwort wiederholen" required>
                </label>
                <button type="submit" class="sub"><span>Registrieren</span></button>
            </form>
        <?php endif; ?>
    </article>
</main>