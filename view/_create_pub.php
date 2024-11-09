<form action="/social/publication" method="post" enctype="multipart/form-data">
    <div class="form-pub col-12 d-flex justify-content-center flex-column">
        <div class="col-12 d-flex pb-2 gap-2">
            <span class="avatar-pub d-flex justify-content-start "><img src="<?= ASSETS ?>img/user.png" alt=""></span>
            <!-- <input type="text" class="input-pub col-10" placeholder="Quoi de neuf ?"> -->
            <div class="create-post flex-fill">
                <textarea class="input-pub col-12" name="contenu" placeholder="Quoi de neuf ?"></textarea>
                <div class="img-post-container col-12 py-2">
                    <img id="imagePreview" src="" alt="Image Preview" style=" width:100%;display: none;">
                </div>

                <div class="d-flex col-12">
                    <div class="col-10 d-flex align-items-center">
                        <div class="upload-file d-flex gap-3 flex-column">
                            <div class="d-flex gap-3">
                                <div>
                                    <input type="file" class="d-none" name="imagePost" id="imagePost">
                                    <label for="imagePost" class="d-inline-block"><img src="<?= ASSETS ?>img/gallery.png" width="" height="2" alt=""></label>
                                </div>
                                <!-- <img src="<?= ASSETS ?>img/gallery.png" width="" height="2" alt=""> -->
                                <img src="<?= ASSETS ?>img/gift.png" width="" height="2" alt="">

                            </div>
                        </div>
                    </div>

                    <div class="col-2 d-flex justify-content-end">
                        <input type="submit" class="publier" value="Publier">
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>