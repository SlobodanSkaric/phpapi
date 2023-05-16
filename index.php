<?php 
header("Content-type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: content-type");
include "./vendor/autoload.php";
use MyControl\Controllers\DatabaseController;
use MyControl\Router\FactoryRouter;
use MyControl\Router\Router;

$dbConnection = DatabaseController::getConnection();

$serverMethod = filter_input(INPUT_SERVER,"REQUEST_METHOD");
$uri = filter_input(INPUT_SERVER,"REQUEST_URI");

$factoryRouter = FactoryRouter::getRoutes($serverMethod)->getRoutes();
$router = new Router($uri,$factoryRouter);
$router->getRouteParam();

$controllorName = "\\MyControl\\Controllers\\" .$router->getController() . "Controller";
$methodName = $router->getMethod();
$argumnet = $router->getArgument();

$controller = new $controllorName($dbConnection);
echo call_user_func_array([$controller, $methodName], $argumnet);