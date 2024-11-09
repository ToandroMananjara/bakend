<?php

if (isset($_SESSION['email'])) {
} else {
    header("location: /social/connexion");
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include(VIEW . '_head.php') ?>

<body>
    <?php include(VIEW . 'header.php') ?>

    <div class="">
        <div class="row-grid ">
            <div class="column  side d-none d-lg-block" style="background-color:#bbb;">
                <a href="/social/profile">
                    <div class="user d-flex col-12 gap-3">
                        <div class="avatar-compte  d-flex justify-content-start ">
                            <img src="<?= ASSETS ?>img/user.png" alt="">
                        </div>
                        <div class="d-flex align-items-center">
                            <?= $datas['user_current']['nom'] . ' ' . $datas['user_current']['prenom'] ?>
                        </div>
                    </div>
                </a>
            </div>

            <div class="column middle col-12 pt-sm-8 px-sm-5 pb-sm-0 pt-5 px-3 pb-0" style="background-color:#ccc;">
                <div class="create-pub-container col-12 mb-4">
                    <div class="create-pub p-2 p-sm-4 ">
                        <?php include(VIEW . '_create_pub.php') ?>
                    </div>
                </div>

                <?php
                foreach ($datas['posts'] as $data) {
                    include(VIEW . '_post.php');
                }
                ?>
            </div>

            <div class="column side d-none d-lg-block" style="background-color:#bbb;">Column</div>
        </div>
    </div>
    <script src="/social/assets/js/reqAjax.js"></script>
    <script src="/social/assets/js/home.js"></script>
</body>

</html>