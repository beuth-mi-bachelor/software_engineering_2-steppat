<main class="content-wrapper">
    <article class="inner-content-wrapper">
        <img src="http://placehold.it/993x559" alt="Logo"/>
        <h2 class="title">Willkommen</h2>
        <em class="logininfo">Der Username und/oder das Passwort waren falsch! Bitte versuchen sie es erneut</em>
        <form id="form" action="index.php?action=contest-overview" method="post">
            <label class="field" id="username">
                <input class="name-input" type="text" name="username" placeholder="Benutzername">
            </label>
            <label class="field" id="password">
                <input type="password" class="pw-input" name="password" placeholder="Passwort">
            </label>
            <button type="submit" class="sub"><span>Anmelden</span></button>
            <a href="index.php?action=register" target="_self">Noch keinen Account?</a>
        </form>
    </article>
</main>