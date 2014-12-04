<?php
include("partials/header.php");
?>
<main class="content-wrapper">
    <article class="inner-content-wrapper">
        <h2 class="title">Gefundene Wettbewerbe</h2>

        <?php
            global $controller;
            $requestSearch = $controller->request["search"];
            $contests = Model::searchContest($requestSearch);
            $ideas = Model::searchIdea($requestSearch);
        ?>

        <?php if (sizeof($contests) != 0) : ?>

            <ul class="contest-entries">
                <?php
                foreach($contests as $item ) {
                    ?>
                    <li class="contest-entry">
                        <h2><?php echo $item["name"]; ?></h2>
                        <img class="contest-picture" src="<?php echo $item["image_url"]; ?>" alt="<?php echo $item["name"]; ?>"/>
                        <p>
                            <span>Startet am: </span>
                            <span class="contest-ends"><?php echo $item["starts_at"]; ?></span>
                        </p>
                        <p>
                            <span>Endet am: </span>
                            <span class="contest-ends"><?php echo $item["ends_at"]; ?></span>
                        </p>
                        <a href="index.php?action=contest-details&id=<?php echo $item["id"]; ?>" target="_self">Details</a>
                    </li>
                <?php
                }
                ?>
            </ul>

        <?php endif; ?>

        <?php if (sizeof($contests) == 0) : ?>

            <em class="info">Es sind keine Wettbewerbe mit dem Namen '<?php echo $requestSearch; ?>' gefunden worde</em>

        <?php endif; ?>

        <h2 class="title">Gefundene Ideen</h2>

        <?php if (sizeof($ideas) != 0) : ?>

            <ul class="ideas-entries">
                <?php
                foreach($ideas as $item ) {
                    ?>
                    <li class="idea-entry">
                        <h2><?php echo $item["name"]; ?></h2>
                        <img class="idea-picture" src="<?php echo $item["image_url"]; ?>" alt="<?php echo $item["name"]; ?>"/>
                        <a href="index.php?action=idea-details&id=<?php echo $item["id"]; ?>" target="_self">Details</a>
                    </li>
                <?php
                }
                ?>
            </ul>

        <?php endif; ?>


        <?php if (sizeof($ideas) == 0) : ?>

            <em class="info">Es sind keine Ideen mit dem Namen '<?php echo $requestSearch; ?>' gefunden worde</em>

        <?php endif; ?>

    </article>
</main>