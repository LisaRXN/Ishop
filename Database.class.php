<?php

class Database
{
    private $pdo;
    private $db_name = 'my_shop';

    private function getPDO()
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO(
                "mysql:dbname=$this->db_name;host=127.0.0.1;port=8889",
                'root',
                'root',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS
                ]
            );
        }
        return $this->pdo;
    }

    public function query($statement, $class_name, $attributes = null, $one = false)
    {
        if($attributes){

            $pdo = $this->getPDO();
            $req = $pdo->prepare($statement);
            $req->execute($attributes);
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
    
            return $one ? $req->fetch() : $req->fetchAll();
            
        }else{
            $pdo = $this->getPDO();
            $req = $pdo->query($statement);
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
    
            return $one ? $req->fetch() : $req->fetchAll();
        }
    }

    public function nonSelect($statement, $attributes=null){
        $pdo = $this->getPDO();
        $req = $pdo->prepare($statement);
        $req->execute($attributes);
    }

}