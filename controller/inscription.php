<?php

class Inscription
{
    public function __construct() {}

    public function createUser()
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

            $nom = $input['name'];
            $prenom = $input['firstName'];
            $dob = $input['dob'];
            $genre = $input['genre'];
            $email = $input['email'];
            $password = $input['password'];

            if (isset($nom) &&  isset($prenom) && isset($email) && isset($password)) {
                $user->nom = $nom;
                $user->prenom = $prenom;
                $user->dob = $dob;
                $user->genre = $genre;
                $user->email = $email;
                $user->password = $password;
                $user->create();

                $userData = [
                    'id' => $user->id, // Assurez-vous que cette propriété existe dans $isUser
                    'name' => $user->nom,
                    'firstName' => $user->prenom,
                    'dob' => $user->dob,
                    'genre' => $user->genre,
                    'email' => $user->email,
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
                    'message' => 'user non creé',
                ]);
                // http_response_code(401); // Unauthorized
            }
        }
    }
}
