<?php 

namespace MyControl\Router;

class PostRouter{
    private $postRouteList = [
        "|^/user/registration/?|" => "Register",
        "|^/user/login/?|" => "Login",
    ];
    
    public function getRoutes(){
        return $this->postRouteList;
    }
}