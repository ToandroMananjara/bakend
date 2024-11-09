<?php
class Connexion
{
    public function __construct() {}

    public function index()
    {
        include_once('view/index.php');
    }

    public function authenticate()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Request-Headers, Authorization");

        // Répondre aux requêtes préflight (OPTIONS)
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = new Database();
            $conn = $data->getConnexion();
            $user = new Compte($conn);

            $input = json_decode(file_get_contents('php://input'), true);
            $email = $input['email'] ?? null;
            $password = $input['password'] ?? null;

            $isUser = $user->isAuthentify($email, $password);
            if ($isUser) {
                // Créer un tableau avec les données de l'utilisateur
                $userData = [
                    'id' => $user->id, // Assurez-vous que cette propriété existe dans $isUser
                    'email' => $user->email,
                    'name' => $user->nom,
                    'firstName' => $user->prenom,
                    'token' => 'your_generated_token_here', // Générer un token si nécessaire
                ];

                echo json_encode([
                    'status' => 'success',
                    'data' => $userData,
                ]);
                http_response_code(200); // Réponse OK
                return;
            } else {
                echo json_encode([
                    'status' => 'failed',
                    'data' => [],
                    'message' => 'Email ou mot de passe incorrect.',
                ]);
                // http_response_code(401); // Unauthorized
            }
        }
    }

    // Déconnexion
    public function logout()
    {
        exit;
    }
}
