<?php 

namespace MyControl\Models;


class UserModel extends Model{
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