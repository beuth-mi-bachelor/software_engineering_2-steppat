<?php
include("partials/header.php");
?>
<main class="content-wrapper">
    <article class="inner-content-wrapper">
        <h2 class="title">Wettbewerb Detailansicht</h2>


        <?php
            global $controller;
            $request = $controller->request;
            $contestDetails = Model::getContest($request["id"]);
            $ideas = Model::getIdeaByContest($request["id"]);

        ?>

        <?php if (sizeof($contestDetails) != 0) : ?>

            <section class="entry">
                <img src="<?php echo $contestDetails["image_url"]; ?>" alt="<?php echo $contestDetails["name"]; ?>" />
                <h2><?php echo $contestDetails["name"]; ?></h2>
                <p class="starts_at"><?php echo $contestDetails["starts_at"]; ?></p>
                <p class="ends_at"><?php echo $contestDetails["ends_at"]; ?></p>
                <p class="description"><?php echo $contestDetails["description"]; ?></p>
                <?php if (Model::isAdmin() || Model::isManager()) : ?>
                    <input type="button" name="edit" value="Bearbeiten"
                       onClick="self.location.href='index.php?action=contest-edit&id=<?php echo $contestDetails["id"]; ?>'">
                <?php endif; ?>

                <input type="button" name="new_idea" value="Neue Idee"
                       onClick="self.location.href='index.php?action=idea-new&id=<?php echo $contestDetails["id"]; ?>'">
            </section>


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
                <em class="info">Dieser Wettbewerb hat bisher keine eingereichten Ideen</em>
            <?php endif; ?>

        <?php endif; ?>

        <?php if (sizeof($contestDetails) == 0) : ?>

            <em class="info">Dieser Wettbewerb existiert leider nicht</em>

        <?php endif; ?>

    </article>
</main>