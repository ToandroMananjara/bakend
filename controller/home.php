<?php
class Home
{
    public $datas;
    public function __construct()
    {
        session_start();
        if (isset($_SESSION['email'])) {
            $userId = $_SESSION['user_id'];
            if (!is_dir('users/' . $userId)) {
                mkdir('users/' . $userId);
            }
            $data = new Database();

            $conn = $data->getConnexion();

            $publication = new Publication($conn);
            $user = new Compte($conn);
            $commentaire = new Commentaire($conn);
            $react_publication = new Reaction_publication($conn);

            $user->id = $userId;
            $myUser = $user->readById($user->id);
            // $posts = $publication->readAll();

            $posts = $publication->readAllWithUser();


            $this->datas = [];
            $this->datas['user_current'] = $myUser; // Stocke les informations de l'utilisateur courant

            $this->datas['posts'] = []; // Initialise un tableau pour les publications


            // Initialize the array to hold new comment structures

            foreach ($posts as $post) {
                // echo "<pre>";
                // var_dump($post);
                // echo "</pre>";



                // Recuperer tout les commentaires de chaque post
                $comments = $commentaire->readAllWithIdPub($post['id']);
                $react_pubs = $react_publication->readAllWithIdPub($post['id']);

                // echo "<pre>";
                // var_dump($react_pubs);
                // echo "</pre>";

                if (sizeof($comments) != 0) {
                    foreach ($comments as $comment) {
                        // Recuperer le user correspond a la commentaire
                        $getUser = $user->readById($comment["id_compte"]);

                        if ($getUser) {
                            $newComment[] = [
                                'user' => [
                                    'id' => $getUser['id'], // Assure-toi que 'id_compte' est disponible
                                    'nom' => $getUser['nom'],
                                    'prenom' => $getUser['prenom']
                                ],
                                'id_comment' => $comment['id'],
                                'contenu' => $comment['contenu'],
                                'date_commentaire' => $comment['date_commentaire'],

                            ];
                        }
                    }

                    $this->datas['posts'][] = [ // Utilise [] pour ajouter au tableau des publications
                        'post_id' => $post['id'],
                        'contenu' => $post['contenu'],
                        'imagePath' => $post['image_name'],
                        'date_publication' => $post['date_publication'],
                        'user' => [
                            'id' => $post['id_compte'], // Assure-toi que 'id_compte' est disponible
                            'nom' => $post['nom'],
                            'prenom' => $post['prenom']          // Assure-toi que 'nom' est disponible
                        ],
                        'react' => $react_pubs,
                        'commentaire' => $newComment


                    ];
                    $newComment = [];  // Remettre le tableau vide a la fin de boucle 
                } else {
                    $this->datas['posts'][] = [ // Utilise [] pour ajouter au tableau des publications
                        'post_id' => $post['id'],
                        'contenu' => $post['contenu'],
                        'imagePath' => $post['image_name'],
                        'date_publication' => $post['date_publication'],
                        'user' => [
                            'id' => $post['id_compte'], // Assure-toi que 'id_compte' est disponible
                            'nom' => $post['nom'],
                            'prenom' => $post['prenom']          // Assure-toi que 'nom' est disponible
                        ],
                        'react' => $react_pubs,
                        'commentaire' => []
                    ];
                }
            }

            // echo "<pre>";
            // var_dump($comments);
            // // var_dump($newComment);
            // // var_dump($datas['posts'][0]);
            // echo "<pre>";

            // echo "<pre>";
            // var_dump($datas);
            // // var_dump($datas['posts'][0]);
            // echo "<pre>";


            // echo "<pre>";
            // // var_dump($comments);
            // // var_dump($newComment);
            // var_dump($datas['posts'][0]['commentaire']);
            // echo "<pre>";
        } else {
            header("location: /social/connexion");
        }
    }
    public function index()
    {
        $myView = new View('homepage');
        $myView->render($this->datas);
    }
    public function readProfile()
    {
        $myView = new View('profile');
        $myView->render($this->datas);
    }
}
