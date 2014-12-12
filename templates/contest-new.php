<?php
include("partials/header.php");
?>
<main class="content-wrapper">
    <article class="inner-content-wrapper">
        <h2 class="title">Neuer Wettbewerb</h2>
        <?php if (Model::isAdmin() || Model::isManager()) : ?>
        <form id="form" action="index.php?action=contest-new" method="post">
            <fieldset>
                <legend>Daten des Wettbewerbs</legend>
                <label class="field" id="name">
                    <input class="name-input" type="text" name="name" placeholder="Name des Wettbewerbs" required>
                </label>
                <label class="field" id="starts_at">
                    <input class="date-input" type="date" name="starts_at" required>
                </label>
                <label class="field" id="ends_at">
                    <input class="date-input" type="date" name="ends_at" required>
                </label>
                <label class="field" id="image_url">
                    <input class="url-input" type="url" name="image_url" placeholder="URL zum Wettbewerbsbild" required>
                </label>
                <label class="field" id="description">
                    <textarea class="description-input" name="description" placeholder="Beschreibung" required></textarea>
                </label>
            </fieldset>
            <button type="submit" class="sub"><span>Wettbewerb erstellen</span></button>
        </form>
        <?php endif; ?>
        <?php if (!Model::isAdmin() && !Model::isManager()) : ?>
            <p>Sie müssen als Manager oder Administrator eingeloggt sein, um Wettbewerbe erstellen zu können.</p>
        <?php endif; ?>
    </article>
</main>