<?php 
header("Content-type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
include "./vendor/autoload.php";
use MyControl\Controllers\DatabaseController;
use MyControl\Router\FactoryRouter;

$dbConnection = DatabaseController::getConnection();

$serverMethod = filter_input(INPUT_SERVER,"REQUEST_METHOD");
$uri = filter_input(INPUT_SERVER,"REQUEST_URI");

$factoryRouter = FactoryRouter::getRoutes($serverMethod)->getRoutes();

$controllerName = "";
$methodName = "";

foreach($factoryRouter as $route=>$method){
    if($uri === $route){
        $controllerName = ucfirst(explode("/",$route)[1]);
        $methodName = $method;
        break;
    }

    $controllerName = null;
    $methodName = null;

}

var_dump($controllerName);
var_dump($methodName);