<?php
include_once('_config.php');
MyAutoload::start();

$request = isset($_GET['r']) ? $_GET['r'] : '';
if ($request == '') {
    $request = 'connexion';
}
$route = new Router($request);
$route->renderController();
