<?php
include("partials/header.php");
?>
<main class="content-wrapper">
    <article class="inner-content-wrapper">
        <h2 class="title">Ideen Detailansicht</h2>

        <?php
        global $controller;
        $request = $controller->request;
        $ideaDetails = Model::getIdea($request["id"]);

        ?>

        <li class="idea-entry">
            <h2><?php echo $ideaDetails["name"]; ?></h2>
            <img class="idea-picture" src="<?php echo $ideaDetails["image_url"]; ?>" alt="<?php echo $item["name"]; ?>"/>
            <p><?php echo $ideaDetails["description"]; ?></p>
            <a href="index.php?action=idea-edit&id=<?php echo $ideaDetails["id"]; ?>" target="_self">Bearbeiten</a>
        </li>

    </article>
</main>