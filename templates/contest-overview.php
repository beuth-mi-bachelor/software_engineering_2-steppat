<?php
include("partials/header.php");
?>
<main class="content-wrapper">
    <article class="inner-content-wrapper">
        <h2 class="title">Liste aller Wettbewerbe</h2>

        <?php
            $contests = Model::getContests();
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

            <em class="info">Es sind keine Wettbewerbe vorhanden</em>

        <?php endif; ?>

    </article>
</main>