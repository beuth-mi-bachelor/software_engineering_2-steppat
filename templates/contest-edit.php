<?php
include("partials/header.php");
?>
<main class="content-wrapper">
    <article class="inner-content-wrapper">
        <h2 class="title">Wettbewerb bearbeiten</h2>
        <?php
                    global $controller;
                    $request = $controller->request;
                    $contestDetails = Model::getContest($request["id"]);

                ?>
        <form id="form" action="index.php?action=contest-edit&id=<?php echo $request["id"]; ?>" method="post">
            <fieldset>
                <legend>Daten des Wettbewerbs</legend>
                <label class="field" id="name">
                    <input class="name-input" type="text" name="name" value="<?php echo $contestDetails["name"]; ?>" required>
                </label>
                <label class="field" id="starts_at">
                    <input class="date-input" type="datetime" name="starts_at" value="<?php echo $contestDetails["starts_at"]; ?>"required>
                </label>
                <label class="field" id="ends_at">
                    <input class="date-input" type="datetime" name="ends_at" value="<?php echo $contestDetails["ends_at"]; ?>"required>
                </label>
                <label class="field" id="image_url">
                    <input class="url-input" type="url" name="image_url" value="<?php echo $contestDetails["image_url"]; ?>" required>
                </label>
                <label class="field" id="description">
                    <textarea class="description-input" name="description" required><?php echo $contestDetails["description"]; ?></textarea>
                </label>
            </fieldset>
            <button type="submit" class="sub"><span>Wettbewerb speichern</span></button>
        </form>
    </article>
</main>