<div class="comment-wrapper">
    <h2>Kommentare</h2>
    <form class="comment-form clearfix" action="index.php?action=idea-details&id=<?php echo $request["id"]; ?>" method="post">
        <textarea name="text"></textarea>
        <input class="comment-send" type="submit" name="add-comment" value="Kommentar hinzufügen">
    </form>
    <?php
    global $controller;
    $requestComment = $controller->request;
    $ideaComments = Model::getComments($request["id"]);
    ?>

    <?php if (sizeof($ideaComments) != 0) : ?>
        <?php
            foreach($ideaComments as $item ) {
            $user = Model::getUsernameById($item["user_id"]);
        ?>
            <blockquote>
                <p><?php echo $item["text"] ?></p>
                <footer>Geschrieben am <?php echo $item["created_at"]->format('d.m.Y H:i:s'); ?> Uhr von <cite title="Source Title"><?php echo $user; ?></cite></footer>
            </blockquote>
        <?php
            }
         ?>
    <?php endif; ?>
    <?php if (sizeof($ideaComments) == 0) : ?>

        <em>Es sind noch keine Kommentare vorhanden. Seien Sie der erste, der einen Kommentar für diese Idee hinterlässt!</em>

    <?php endif; ?>
</div>