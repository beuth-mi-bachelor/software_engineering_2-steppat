<?php
include("partials/header.php");
?>
<main class="content-wrapper">
    <article class="inner-content-wrapper">
        <h2 class="title">Idee bearbeiten</h2>
        <?php
        global $controller;
        $request = $controller->request;
        $modelDetails = Model::getIdea($request["id"]);

        ?>
        <form id="form" action="index.php?action=idea-edit&id=<?php echo $request["id"]; ?>" method="post">
            <fieldset>
                <legend>Daten der Idee</legend>
                <label class="field" id="name">
                    <input class="name-input" type="text" name="name" value="<?php echo $modelDetails["name"]; ?>" required>
                </label>
                <label class="field" id="image_url">
                    <input class="url-input" type="url" name="image_url" value="<?php echo $modelDetails["image_url"]; ?>" required>
                </label>
                <label class="field" id="description">
                    <textarea class="description-input" name="description" required><?php echo $modelDetails["description"]; ?></textarea>
                </label>
            </fieldset>
            <button type="submit" class="sub"><span>Wettbewerb speichern</span></button>
        </form>
    </article>
</main>