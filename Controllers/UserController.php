<?php 

namespace MyControl\Controllers;
use MyControl\Models\Model;
use MyControl\Models\UserModel;

class UserController extends Controller{

    public function All(){
        return "All...";
    }

    public function getUser(){
        return "Get one user";
    }


    public function Register(){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        
        $userModel = new UserModel($this->getConnection());

        $userModel->userRegistration($username, $email, $password);
    }

    public function Login(){
        return "Login...";
    }

}