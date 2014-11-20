<?php
include("partials/header.php");
?>
<main class="content-wrapper">
    <article class="inner-content-wrapper">
        <h2 class="title">Neuer Idee</h2>
        <?php
        global $controller;
        $request = $controller->request;
        ?>
        <form id="form" action="index.php?action=idea-new&id=<?php echo $request["id"]; ?>" method="post">
            <fieldset>
                <legend>Daten der Idee</legend>
                <label class="field" id="name">
                    <input class="name-input" type="text" name="name" placeholder="Name der Idee" required>
                </label>
                <label class="field" id="image_url">
                    <input class="url-input" type="url" name="image_url" placeholder="URL zum Wettbewerbsbild" required>
                </label>
                <label class="field" id="description">
                    <textarea class="description-input" name="description" placeholder="Beschreibung" required></textarea>
                </label>
            </fieldset>
            <button type="submit" class="sub"><span>Idee erstellen</span></button>
        </form>
    </article>
</main>