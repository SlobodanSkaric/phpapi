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
$argumnets = "";

foreach($factoryRouter as $route=>$method){
    if(preg_match($route, $uri)){
        if(preg_match_all($route, $uri,$match)){
            if(isset($match[1][0])){
                $argumnets = $match[1][0];
            }
        }
        $controllerName = ucfirst(explode("/",$route)[1]);
        $methodName = $method;
        break;
    }

    $controllerName = null;
    $methodName = null;

}

var_dump($controllerName);
var_dump($methodName);
var_dump($argumnets);