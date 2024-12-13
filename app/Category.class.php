<?php
include_once("Database.class.php");
class Category extends Table
{
    protected $table = "categories";
    protected $db;


    public function getAll()
    {
        $stm = "SELECT * from $this->table";
        return $this->db->query($stm, get_called_class());
    }


    public function getBySearch($search)
    {
        $stm = "SELECT * FROM $this->table WHERE name LIKE ?";
        $result = "%$search%";

        return $this->db->query(
            $stm,
            get_called_class(),
            [$result]
        );
    }


    public function update($name, $id)
    {
        $stm = "UPDATE $this->table SET name = :name WHERE id = :id";

        return $this->db->nonSelect(
            $stm,
            [
                ":name" => $name,
                ":id" => $id
            ]
        );
    }


    public function add($name)
    {
        $stm = "INSERT INTO $this->table (name) VALUES (:name)";
        return $this->db->nonSelect(
            $stm,
            [
                ":name" => $name
            ]
        );
    }

}





