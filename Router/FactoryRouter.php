<?php 

namespace MyControl\Router;
use MyControl\Router\PostRouter;
use MyControl\Router\GetRouter;

class FactoryRouter {

    public static function getRoutes($method){
        switch($method){
            case $method === "GET":
                return new GetRouter();
            case $method === "POST":
                return new PostRouter();
            default:
                return [];
        }
    }
}