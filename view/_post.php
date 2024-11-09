<div class="post mt-2 p-2 p-sm-4  position-relative col-12" data-id="<?= $data['post_id'] ?>">
    <!-- <input type="hidden" id="id_comment" name="id_post" value="<?= $data['post']['id'] ?>"> -->


    <?php
    $id_compte = $_SESSION['user_id'];
    if ($data['user']['id'] == $id_compte) {

        echo "<div class='more-post position-absolute' onclick='handleMorePost(this)'>...</div>";
    } else
        echo "";
    ?>

    <div class="col-12">
        <div class=" d-flex col-12 gap-3">
            <div class="avatar-compte">
                <img src="<?= ASSETS ?>img/user.png" alt="">
            </div>
            <div class="nom d-flex align-items-center"><?= $data['user']['nom'] . " " . $data['user']['prenom'] ?></div>
        </div>

        <div class="contenu col-12">
            <p class="pt-3 pb-2 "><?= $data['contenu'] ?></p>
            <div class="col-12 ">
                <img class="col-12" src="<?= USERS  . $data['imagePath'] ?>" alt="" srcset="">
                <!-- <a href="<?= USERS  . $data['imagePath'] ?>"><?= $data['imagePath'] ?></a> -->
            </div>
            <div>
                <?php
                $id_compte = $_SESSION['user_id'];
                $currentReact = "";
                $currentIconReact = "";


                $data['react'];
                $count = 0;
                foreach ($data['react'] as $key => $react) {
                    $count++;
                    if ($react['id_compte'] == $id_compte) {
                        $currentReact = $react['type'];
                    }
                }
                switch ($currentReact) {
                    case "aime":
                        $currentIconReact = "img/like.png";
                        $currentReact = "J'aime";
                        break;

                    case "adore":
                        $currentIconReact = "img/heart.png";
                        $currentReact = "J'adore";
                        break;

                    case "haha":
                        $currentIconReact = "img/haha.png";
                        $currentReact = "Haha";
                        break;

                    case "triste":
                        $currentIconReact = "img/sad-face.png";
                        $currentReact = "Triste";
                        break;

                    case "colere":
                        $currentIconReact = "img/angry.png";
                        $currentReact = "Grrr";
                        break;

                    default:
                        $currentIconReact = "img/like-nb.png";
                        break;
                }

                if (!$currentReact) {
                    $currentReact = "J'aime";
                }
                if ($count == 0) {
                } else
                    echo "<span>" . $count . " " . "réactions" . "</span>";
                ?>
            </div>
            <div class="action">
                <!-- <hr> -->
                <!-- <?= $currentReact ?> -->
                <div class="d-flex p-4 pt-0 pb-0">
                    <div class="like react-container col-6 d-flex align-items-center gap-2">
                        <div class="like-container d-flex align-items-center gap-2" onmouseover="handleReactHover(this)" onmouseout="handleReactOutHover(this)">
                            <img src="<?= ASSETS . $currentIconReact ?>" data-current-react="<?= $currentReact  ?>" class="react-img cursor-pointer" id="">
                            <span class="react-label cursor-pointer " id=""><?= $currentReact ?></span>

                        </div>
                        <div class="react">
                            <div class="react-item d-flex align-items-center gap-3 justify-content-around p-3 pb-2 pt-2">
                                <img src="<?= ASSETS ?>img/like.png" class="reaction-icon" data-reaction="aime" onclick="reacting(this)">
                                <img src="<?= ASSETS ?>img/heart.png" class="reaction-icon" data-reaction="adore" onclick="reacting(this)">
                                <img src="<?= ASSETS ?>img/haha.png" class="reaction-icon" data-reaction="haha" onclick="reacting(this)">
                                <img src="<?= ASSETS ?>img/sad-face.png" class="reaction-icon" data-reaction="triste" onclick="reacting(this)">
                                <img src="<?= ASSETS ?>img/angry.png" class="reaction-icon" data-reaction="colere" onclick="reacting(this)">
                            </div>
                        </div>
                    </div>

                    <div class="chat-comment col-6 d-flex justify-content-end align-items-center gap-2" onclick="focusComment(this)">
                        <img src="<?= ASSETS ?>img/chat-comment.png">
                        <span>Commenter</span>
                    </div>
                </div>
                <hr>
                <!-- Section commentaire  -->
                <div class="comment-container">
                    <div class="comment-cards">
                        <?php
                        if ($data['commentaire']) {
                            foreach ($data['commentaire'] as $comment) {
                                include_once(VIEW . '_comment.php');
                                echo renderComment($comment);  // Use the renderComment function to output the HTML
                            }
                        }
                        ?>
                    </div>
                </div>


                <div class="comment d-flex col-12 gap-2 mt-2 mb-2">
                    <div class="avatar-compte">
                        <img src="<?= ASSETS ?>img/user.png" alt="">
                    </div>
                    <div class="input-comment-container flex-fill align-items-center ">
                        <!-- <form class="flex-fill " method="post"> -->
                        <div class="col-12 d-flex gap-2">
                            <!-- <input type="hidden" name="id_pub" value="<?= $data['post_id'] ?>"> -->
                            <input type="text" class="input-comment flex-fill" name="commentaire" class="form-control" style="height:3em" placeholder="Votre commentaire ..." required>
                            <div class=" d-flex justify-content-end " data-id="<?= $data['post_id'] ?>" onclick="comment(this)">
                                <span class="send-comment"><img src="<?= ASSETS ?>img/send.png"></span>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>