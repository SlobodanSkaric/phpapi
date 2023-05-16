<?php 

namespace MyControl\Core;
use Firebase\JWT\JWT;

class JWTToken{
    private $username;
    private $userId;
    private $serverName;
    private $securityKey;
    private $time;
    private $expirieTime;

    private $payload = [];
    

    public function __construct($username, $userId, $securityKey ,$time){
        $this->username = $username;
        $this->userId = $userId;
        $this->serverName = $_SERVER["SERVER_NAME"];
        $this->securityKey = $securityKey;
        $this->time = $time;
        $this->expirieTime = $time + 60;
    }

    private function setPaylod(){
        $this->payload = [
            "iat" => $this->time,
            "iss" => $this->serverName,
            "exp" => $this->expirieTime,
            "username" => $this->username,
            "userId" => $this->userId
        ];
    }

    public function setToken(){
        $this->setPaylod();
        $jwt = JWT::encode($this->payload, $this->securityKey, "HS512");
        return $jwt;
    }
}