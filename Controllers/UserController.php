<?php 

namespace MyControl\Controllers;
use MyControl\Models\Model;
use MyControl\Models\UserModel;
use MyControl\Core\JWTToken;

class UserController extends Controller{

    public function All(){
        $allUser = new UserModel($this->getConnection());

        var_dump($allUser->All());
    }

    public function getUser($id){
        $getUSerId = new UserModel($this->getConnection());

        return $getUSerId->getUserId($id);
    }


    public function Register(){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        
        $userModel = new UserModel($this->getConnection());

        $userModel->userRegistration($username, $email, $password);
    }

    public function Login(){
        $clientJsonData = file_get_contents("php://input");
        $dataDecode = json_decode($clientJsonData);

        $email = $dataDecode->email;
        $password = $dataDecode->password;
        
        $userModel = new UserModel($this->getConnection());

        $result = $userModel->loginUser($email);

        if(empty($result)){
           return json_encode(["message", "Email address is not valid"]);
        }

        $passwordVerify = password_verify($password,$result[0]->password);

        if(!$passwordVerify){
            return json_encode(["message", "Password is not valid"]);
        }

        $time = time();
        $token = new JWTToken($result[0]->username, $result[0]->id ,"hghghgahghgnIDFjdfijrijhnapejnfhdhyxcn"/*implement security key*/, $time);
        var_dump($token->setToken());
        return json_encode(["message", "true"]);
    }

}