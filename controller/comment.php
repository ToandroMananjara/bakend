<?php
class Comment
{
    public function __construct() {}
    public function index($posts) {}

    public function createComment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();
            $data = new Database();

            $conn = $data->getConnexion();

            $user = new Compte($conn);
            $commentaire = new Commentaire($conn);

            $id_compte = $_SESSION['user_id'];
            $id_pub = $_POST['id_pub'];
            $contenu = $_POST['commentaire'];

            if (isset($id_pub) &&  isset($id_compte) &&  isset($contenu)) {
                $commentaire->id_compte = $id_compte;
                $commentaire->contenu = $contenu;
                $commentaire->id_pub = $id_pub;

                $commentaire->create();

                $lastId = $conn->lastInsertId();
                $commentaire->id = $lastId;

                $getUser = $user->readById($id_compte);
                $comment = $commentaire->readById();

                if ($getUser) {
                    // Prepare the new comment object
                    $newComment = [
                        'user' => [
                            'id' => $getUser['id'],  // Assuming this is available in user data
                            'nom' => $getUser['nom'],
                            'prenom' => $getUser['prenom']
                        ],
                        'id_comment' => $comment['id'],
                        'contenu' => $comment['contenu'],
                        'date_commentaire' => $comment['date_commentaire'],
                    ];

                    // Return the new comment as a JSON response
                    echo json_encode(['status' => 'success', 'new_comment' => $newComment]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'User not found']);
                }




                // header('Location: /social/home');
            }
        }
    }

    public function deleteComment()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $data = new Database();

            $conn = $data->getConnexion();

            $commentaire = new Commentaire($conn);
            $commentaire->delete($id);
            header('Location: /social/home');
        }
    }

    public function editComment()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $data = new Database();

            $conn = $data->getConnexion();
            $commentaire = new Commentaire($conn);

            $commentaire->delete($id);
            header('Location: /social/home');
        }
    }
}
