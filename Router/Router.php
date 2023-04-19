<?php 

namespace MyControl\Router;

class Router{
    private string $controllerName;
    private string $methodName;
    private  $argumnets = [];
    private string $uri;
    private  $factoryRouter = [];

    public function __construct(string $uri, array $factoryRouter){
        $this->uri = $uri;
        $this->factoryRouter = $factoryRouter;
    }

    public function getRouteParam(){
        foreach($this->factoryRouter as $route=>$method){
            if(preg_match($route, $this->uri)){
                if(preg_match_all($route, $this->uri,$match)){
                    if(isset($match[1][0])){
                        $this->argumnets[] = $match[1][0];
                    }
                }
                $this->controllerName = ucfirst(explode("/",$route)[1]);
                $this->methodName = $method;
            }
            
            //this part is must be refactoring
            /* $this->controllerName = null;
            $this->methodName = null; */
        
        }
    }


    public function getController(){
        return $this->controllerName;
    }

    public function getMethod(){
        return $this->methodName;
    }

    public function getArgument(){
        return $this->argumnets;
    }


}