<?php 

namespace MyControl\Router;

class GetRouter{
    private $getRouterList = [
        "|^/user/?$|" => "All",
        "|^/user/([0-9]+)/?|" => "getUser"
    ];

    public function getRoutes(){
        return $this->getRouterList;
    }
}