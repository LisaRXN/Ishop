<?php
class Table
{
    protected $table;
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function all(){
        $stm = "SELECT * from $this->table";
        $result = $this->db->query($stm, get_called_class());
        return $result ? $result : false;
    }

    public function getColumn($name)
    {
        $stm = "SELECT DISTINCT $name from $this->table";
        $result = $this->db->query($stm, get_called_class());
        return $result ? $result : false;
    }

    public function getById($id)
    {
        $stm = "SELECT * FROM $this->table WHERE id = ?";
        return $this->db->query(
            $stm,
            get_called_class(),
            [$id],
            true
        );
    }


    public function delete($id)
    {
        $stm = "DELETE FROM $this->table WHERE id = ?";
        return $this->db->nonSelect(
            $stm,
            [$id]
        );
    }

    public function count()
    {
        $stm = "SELECT count(id) as count from $this->table";
        $result = $this->db->query($stm, get_called_class(), null, true);
        return $result ? $result->count : 0;
    }

    public function getTable()
    {
        return $this->table;
    }


}