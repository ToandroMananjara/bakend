<?php
function renderComment($comment)
{
    ob_start(); // Start output buffering
?>
    <div class=" d-flex gap-2 mt-2 mb-2 position-relative col-12 commenter" onclick="handleComment()">
        <div class="more-commentaire position-absolute" onclick="handleMoreComment(this)">
            ...
        </div>
        <div class="d-flex">
            <div class="avatar-compte">
                <img src="<?= ASSETS ?>img/user.png" alt="">
            </div>
        </div>

        <div class="comment-item flex-fill p-2 col-10" data-id-comment="<?= $comment['id_comment'] ?>">
            <div class="nom d-flex align-items-center text-primary">
                <?= htmlspecialchars($comment['user']['nom']) . " " . htmlspecialchars($comment['user']['prenom']) ?>
            </div>
            <p class="comment-contenu"><?= htmlspecialchars($comment['contenu']) ?></p>
        </div>
    </div>
<?php
    return ob_get_clean(); // Get buffered output and clean it
}
?>