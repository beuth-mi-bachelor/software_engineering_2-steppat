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

        <li class="entry">
            <h2><?php echo $ideaDetails["name"]; ?></h2>
            <img class="idea-picture" src="<?php echo $ideaDetails["image_url"]; ?>" alt="<?php echo $ideaDetails["name"]; ?>"/></br></br></br></br></br></br>
            <p><?php echo $ideaDetails["description"]; ?></p>
            <?php if ($ideaDetails["user_id"] == $_SESSION["user-id"] || Model::isAdmin() || Model::isManager()) : ?>
            <a href="index.php?action=idea-edit&id=<?php echo $ideaDetails["id"]; ?>" target="_self">Bearbeiten</a>
            <?php endif; ?>
        </li>

        <?php
        include("partials/comment.php");
        ?>

    </article>
</main>