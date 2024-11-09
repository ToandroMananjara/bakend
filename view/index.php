<!DOCTYPE html>
<html lang="en">

<?php include(VIEW . '_head.php') ?>


<body>
    <div id="root">
        <div class="container col-12">
            <div class="form-container  col-sm-7 col-lg-6 col-12 p-md-4 ">
                <div class="form col-12">
                    <?php

                    if (isset($_SESSION['errorMessage'])) {
                        // Affichez le message d'erreur
                        echo "<span class='error-message'>" . $_SESSION['errorMessage'] . "</span>";

                        // Supprimez le message d'erreur de la session pour qu'il ne s'affiche pas à nouveau lors des requêtes suivantes
                        unset($_SESSION['errorMessage']);
                    }

                    ?>
                    <h1>Login</h1>
                    <form action="/social/connexion/authenticate" class="col-12" method="post">
                        <label for="email">Email:</label><br>
                        <input type="text" name="email" class="input" placeholder="Entrer email" required><br>
                        <label for="password">Password:</label><br>
                        <div class="password-container">
                            <input type="password" name="password" id="password" class="input" placeholder="Entrer password" required><br>
                            <div class="icon">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </div>
                        </div>
                        <input type="submit" id="login" value="Connexion">
                        <div class="mot-passe-oublié ">
                            <a href="">Mot de passe oublié ?</a>
                        </div>
                        <hr style="margin: 2em 0 ;">
                        <input type="button" onclick="handleInscription()" class="signup" value="Inscription">
                    </form>
                </div>
            </div>
            <div class="pop-up-container ">
                <div class="pop-up p-5 " style="box-shadow: 0em .5em 1em  #b8b4b4;width:fit-content;border-radius:1em; width:500px">
                    <div class="cancel" onclick="handleCancel()"><img src="<?= ASSETS ?>img/close.png" class="cursor-pointer"></div>
                    <div class="">
                        <div class=" mb-3">
                            <h2>S'incrire</h2>
                            <p class="text-muted">
                                C'est simple et rapide.
                            </p>
                        </div>
                        <hr>
                    </div>

                    <div class=" d-flex justify-content-center">
                        <form action="/social/inscription" method="post" style="width:50vw; min-width:300px;">
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="nom" class="form-label">Nom:</label>
                                    <input type="text" class="myInput form-control " name="nom" placeholder="Votre nom" required>
                                </div>

                                <div class="col">
                                    <label for="prenom" class="form-label">Prenom:</label>
                                    <input type="text" class="myInput form-control " name="prenom" placeholder="Votre prenom" value="" required>
                                </div>
                            </div>

                            <div class="col mb-2">
                                <div class="col">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="myInput form-control " name="email" placeholder="Votre email" value="" required>
                                </div>

                                <div class="col">
                                    <label for="password" class="form-label">Mot de passe:</label>
                                    <input type="password" class="myInput form-control " name="password" placeholder="Votre mot de passe" value="" required>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Doloremque alias quisquam quasi reprehenderit optio nostrum, voluptatem ex neque adipisci dolorem corporis officia esse quia quo. Aliquam incidunt omnis autem repudiandae.</p>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="submit" class="submit-inscription" value="Inscription">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="/social/assets/js/index.js"></script>
</body>

</html>