<?php

class Router
{
    private $request;
    // private $routes = ["home" => "home", "publication" => "publication", "connexion" => "connexion"];
    private $routes = [
        'connexion' => ['controller' => 'connexion', 'action' => 'index'],
        'connexion/authenticate' => ['controller' => 'connexion', 'action' => 'authenticate'],
        'deconnexion' => ['controller' => 'connexion', 'action' => 'logout'],
        'home' => ['controller' => 'home', 'action' => 'index'],
        'home/publication' => ['controller' => 'home', 'action' => 'index'],
        'inscription' => ['controller' => 'inscription', 'action' => 'createUser'],
        'publication' => ['controller' => 'post', 'action' => 'createPublication'],
        'comment' => ['controller' => 'comment', 'action' => 'createComment'],
        'comment/delete' => ['controller' => 'comment', 'action' => 'deleteComment'],
        'post/delete' => ['controller' => 'post', 'action' => 'deletePost'],
        'react' => ['controller' => 'reaction_pub', 'action' => 'reactPost'],
        'profile' => ['controller' => 'home', 'action' => 'readProfile']


    ];
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function renderController()
    {
        $request = $this->request;

        if (array_key_exists($request, $this->routes)) {
            // Récupérer le contrôleur et l'action correspondant à la route
            $route = $this->routes[$request];  // Utilisation de $this->routes pour accéder aux routes

            // Instanciation du contrôleur
            $controller = new $route['controller']();

            // $controller = new Post();

            // Appel de l'action associée
            $controller->{$route['action']}();
        } else {
            echo "Page not found";
        }
    }
}
