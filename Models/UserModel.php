<?php 

namespace MyControl\Models;


class UserModel extends Model{

    public function All(){//this method is only admin, is very sensitive,maybe not implement in finaly version
        $sql = "SELECT * FROM user";
        $prep = $this->getDatabase()->prepare($sql);
        $exe = $prep->execute();
        $res = [];

        if($exe){
            $res = $prep->fetchAll(\PDO::FETCH_OBJ);
        }

        return json_encode($res);
    }

    public function getUserId(int $id){
        $sql = "SELECT * FROM user WHERE id=?";
        $prep = $this->getDatabase()->prepare($sql);
        $exe = $prep->execute([$id]);
        $res = NULL;

        if($exe){
            $res = $prep->fetch(\PDO::FETCH_OBJ);
        }

        return json_encode($res);
    }

    public function loginUser(string $email){
        $sql = "SELECT * FROM user WHERE email=?";
        $prep = $this->getDatabase()->prepare($sql);
        $exe = $prep->execute([$email]);
        $res = [];

        if($exe){
            $res = $prep->fetchAll(\PDO::FETCH_OBJ);
        }

        return $res;
    }
    public function userRegistration(string $username, string $email, string $password ):bool{
        $sqlCheckUserEmail = "SELECT * FROM user WHERE email=?";
        $prep = $this->getDatabase()->prepare($sqlCheckUserEmail);
        $exe = $prep->execute([$email]);
        $res = NULL;

        if($exe){
            $res = $prep->fetch(\PDO::FETCH_OBJ);
        }
        
        if(!$res){
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user(username, email, password) VALUES (?,?,?)";
            $prep = $this->getDatabase()->prepare($sql);
            $exe = $prep->execute([$username,$email,$passwordHash]);
            return true;
        }

        return false;
       
    }

}