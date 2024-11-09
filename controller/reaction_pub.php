    <?php
    class Reaction_pub
    {
        public function __construct() {}
        public function index($posts) {}

        public function reactPost()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                session_start();
                $data = new Database();

                $conn = $data->getConnexion();

                $reaction_publication = new Reaction_publication($conn);

                $id_publication = $_POST['id_pub'];
                $reaction = $_POST['reaction'];
                $id_compte = $_SESSION['user_id'];
                // $id_pub = $_POST['id_pub'];

                $reaction_publication->id_pub = $id_publication;
                $reaction_publication->id_compte = $id_compte;
                $reaction_publication->type = $reaction;


                $reaction_publication->react();
                // Vérification si l'utilisateur a déjà réagi à cette publication

                // Redirection vers la page d'accueil
                exit();
            }
        }
    }
