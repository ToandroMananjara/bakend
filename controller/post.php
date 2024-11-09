<?php
class Post
{
    public function __construct() {}
    public function index($posts) {}

    public function createPublication()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();
            $data = new Database();

            $conn = $data->getConnexion();

            $publication = new Publication($conn);

            $id_compte = $_SESSION['user_id'];
            $contenu = $_POST['contenu'];

            $image = $_FILES['imagePost'];


            $imageName = $image['name'];
            $imageTmpName = $image['tmp_name'];
            $uploadDir = 'users/' . $id_compte;
            $filePath = $uploadDir . '/' . basename($imageName);

            var_dump($imageName);
            // var_dump($imageTmpName);
            var_dump($image);
            move_uploaded_file($imageTmpName, $filePath);

            if (isset($id_compte) &&  isset($contenu)) {

                $publication->id_compte = $id_compte;
                $publication->contenu = $contenu;
                $publication->imagePost =  $id_compte . '/' . $image["name"];
                var_dump($publication->imagePost);

                $publication->create();

                header('Location: /social/home');
            }
        }
    }

    public function deletePost()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $data = new Database();

            $conn = $data->getConnexion();

            $commentaire = new Commentaire($conn);
            $publication = new Publication($conn);
            $reaction_publication = new Reaction_publication($conn);

            $commentaire->deleteAll($id);
            $reaction_publication->deleteAll($id);
            $pathImage = $publication->delete($id);
            $file = USERS . $pathImage;
            if (file_exists($file)) {
                if (unlink($file)) {
                    echo "File successfully deleted.";
                } else {
                    echo "Error deleting the file.";
                }
            } else {
                echo "File does not exist.";
            }
            // header('Location: /social/home');
        }
    }
}
