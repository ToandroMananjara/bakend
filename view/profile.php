<?php

if (isset($_SESSION['email'])) {
} else {
    header("location: /social/connexion");
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include(VIEW . '_head.php') ?>

<body style="background-color:#ccc;">
    <?php include(VIEW . 'header.php') ?>

    <div class=" profile-container col-12 d-flex justify-content-center">
        <div class="profile-item col-9 ">
            <div class="profile-item-picture ">
                <div class="cover-picture-container position-relative col-12">
                    <img class="cover-picture col-12" id="cover-picture" src="" alt="Photo de couverture">

                    <label for="coverPicture" class="cover-picture-add position-absolute  d-flex align-items-center gap-2">
                        <img class="" src="<?= ASSETS ?>img/photo-camera.png" alt="Photo de profile">
                        <span class="">Changer la photo de couverture</span>
                    </label>
                    <input type="file" class="d-none" name="coverPicture" id="coverPicture">
                </div>
                <div class="profile-picture-container d-flex col-12">
                    <div class="profile-picture-card position-relative ">
                        <img class="profile-picture col-12" id="profile-picture" src="<?= ASSETS ?>img/user.png" alt="Photo de profile">
                        <label for="profilePicture" class="profile-picture-add position-absolute">
                            <img class="" src="<?= ASSETS ?>img/photo-camera.png" alt="Photo de profile">
                        </label>
                        <input type="file" name="profilePicture" id="profilePicture" class="d-none">
                    </div>
                    <div class="profile-details d-flex flex-column ">
                        <div class="profile-name ">
                            <?= $datas['user_current']['nom'] . ' ' . $datas['user_current']['prenom'] ?>
                        </div>
                        <div>
                            nombre d'amis
                        </div>
                    </div>

                </div>
            </div>


        </div>

        <?php
        // echo "<pre>";
        // var_dump($datas['user_current']);
        // echo "</pre>";

        ?>
    </div>
    <div class="col-12 d-flex justify-content-center py-4">
        <div class="profile-column col-8 d-flex gap-3 ">
            <div class="left-container ">
                left

            </div>
            <div class="right-container d-flex flex-column">
                <div class="create-pub-profile">
                    <?php include(VIEW . '_create_pub.php') ?>
                </div>
                <?php
                foreach ($datas['posts'] as $data) {
                    if ($data['user']['id'] == $_SESSION['user_id']) {
                        include(VIEW . '_post.php');
                    }
                }
                ?>
            </div>

        </div>
    </div>
    <script src="/social/assets/js/reqAjax.js"></script>
    <script src="/social/assets/js/home.js"></script>

</body>

</html>