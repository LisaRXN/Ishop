<?php

include_once("Database.class.php");

class User extends Table
{
    protected $table = "users";
    protected $db;


    public function getAll()
    {
        $stm = "SELECT * from $this->table";
        return $this->db->query($stm, get_called_class());
    }

    public function getByEmail($email)
    {
        $stm = "SELECT * FROM $this->table WHERE email = ?";
        return $username = $this->db->query(
            $stm,
            get_called_class(),
            [$email],
            true
        );
    }


    public function login($email, $password)
    {
        $stm = "SELECT * FROM $this->table WHERE email = ?";

        $user = $this->db->query(
            $stm,
            get_called_class(),
            [$email],
            true
        );

        if ($user) {
            if (password_verify($password, $user->password)) {
                session_start();
                $_SESSION['username'] = $user->username;
                $_SESSION['email'] = $user->email;
                $_SESSION['avatar'] = $user->avatar;
                return true;
            }
        }
    }

    public function register($username, $email, $password)
    {
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);

        $stm = "INSERT INTO $this->table (username, email, password, admin) 
                VALUES (:username, :email, :password, 0)";

        return $this->db->nonSelect(
            $stm,
            [
                ":username" => $username,
                ":email" => $email,
                ":password" => $hash_pass
            ]
        );

    }

    public function update($username, $id, $email, $admin)
    {
        $stm = "UPDATE $this->table 
            SET username = :username, email = :email, admin = :admin
            WHERE id = :id";

        return $this->db->nonSelect(
            $stm,
            [
                ":username" => $username,
                ":id" => $id,
                ":email" => $email,
                ":admin" => $admin
            ]
        );
    }

    public function add($username, $email, $admin )
    {
        $stm = "INSERT INTO $this->table (username, email, admin)
            VALUES (:username, :email, :admin)";

        return $this->db->nonSelect(
            $stm,
            [
                ":username" => $username,
                ":email" => $email,
                ":admin" => $admin            
            ]
        );
    }

    public function addToken($id, $token, $token_expire)
    {
        $stm = "UPDATE $this->table SET token = :token, token_expire = :token_expire WHERE id = :id";

        return $this->db->nonSelect(
            $stm,
            [
                ":token" => $token,
                ":token_expire" => $token_expire,
                ":id" => $id
            ]
        );

    }

    public function getByToken($token){
        
        $stm ='SELECT * FROM users WHERE token = :token';
        
        return $this->db->query(
            $stm,
            get_called_class(),
            [':token'=> $token],
            true
        );
    }


    public function updatePassword($id, $password)
    {
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);

        $stm = "UPDATE $this->table SET password = :password WHERE id = :id";

        return $this->db->nonSelect(
            $stm,
            [
                ":password" => $hash_pass,
                ":id" => $id,
            ]
        );

    }

    public function updateProfile( $email, $avatar=null , $username , $firstname=null, $lastname=null, $street=null, $city=null, $zipcode=null, $birthday=null ){

        $stm = "UPDATE $this->table 
            SET 
            avatar = :avatar,
            username = :username,
            firstname = :firstname,
            lastname = :lastname,
            street = :street,
            city = :city,
            zipcode = :zipcode,
            birthday = :birthday

            WHERE email = :email";

        return $this->db->nonSelect(
            $stm,
            [
                ":avatar" => $avatar,
                ":username" => $username,
                ":firstname" => $firstname,
                ":lastname" => $lastname,
                ":street" => $street,
                ":city" => $city,
                ":zipcode" => $zipcode,
                ":birthday" => $birthday,
                ":email" => $email
            ]
        );
    }


    public function saveInfo( $email, $firstname, $lastname, $street, $city, $zipcode ){

        $stm = "UPDATE $this->table 
            SET 
            firstname = :firstname,
            lastname = :lastname,
            street = :street,
            city = :city,
            zipcode = :zipcode

            WHERE email = :email";

        return $this->db->nonSelect(
            $stm,
            [
                ":firstname" => $firstname,
                ":lastname" => $lastname,
                ":street" => $street,
                ":city" => $city,
                ":zipcode" => $zipcode,
                ":email" => $email
            ]
        );
    }

}


