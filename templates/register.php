<main class="content-wrapper">
    <article class="inner-content-wrapper">
        <img src="http://placehold.it/993x559" alt="Logo" />
        <h2 class="title">Registrieren</h2>
        <form id="form" action="../php/functions.php" method="post">
            <label class="field" id="username">
                <input class="name-input" type="text" name="username" placeholder="Benutzername">
            </label>
            <label class="field" id="e-mail">
                <input class="e-mail-input" type="email" name="email" placeholder="E-Mail-Adresse">
            </label>
            <label class="field" id="password">
                <input type="password" class="pw-input" name="password" placeholder="Passwort">
                <input type="password" class="pw-input-repeat" name="password-repeat" placeholder="Passwort wiederholen">
            </label>
            <button type="submit" class="sub"><span>Registrieren</span></button>
        </form>
    </article>
</main>