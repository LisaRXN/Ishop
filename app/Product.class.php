<?php
include_once("Database.class.php");
class Product extends Table
{
    protected $table = "products";
    protected $db;
    public function getAll()
    {
        if (isset($_GET['collection'])) {
            $stm = "SELECT *, products.name AS name, products.id AS id, categories.name AS category_name FROM $this->table 
            LEFT JOIN categories ON $this->table.category_id = categories.id
            WHERE collection = ? ";
            return $this->db->query(
                $stm,
                get_called_class(),
                [$_GET['collection']]
            );
        }
        if (isset($_GET['color'])) {
            $stm = "SELECT *,products.name AS name, products.id AS id, categories.name AS category_name FROM $this->table 
            LEFT JOIN categories ON $this->table.category_id = categories.id
            WHERE color = ? ";
            return $this->db->query(
                $stm,
                get_called_class(),
                [$_GET['color']]
            );
        }
        if (isset($_GET['category'])) {
            $stm = "SELECT *,products.name AS name, products.id AS id, categories.name AS category_name FROM $this->table 
            LEFT JOIN categories ON $this->table.category_id = categories.id            
            WHERE categories.name = ? ";

            return $this->db->query(
                $stm,
                get_called_class(),
                [$_GET['category']]
            );
        }

        if ( isset($_GET['range-min']) && isset($_GET['range-max'])) {

            $stm = "SELECT * , products.name AS name , products.id AS id, categories.name AS category_name, products.price AS price FROM $this->table 
            LEFT JOIN categories ON $this->table.category_id = categories.id
            WHERE price >= ? AND price <= ? ";

            return $this->db->query(
                $stm,
                get_called_class(),
                [
                    $_GET['range-min'],
                    $_GET['range-max'],
                ]
            );
        }





        $stm = "SELECT *,products.name AS name, products.id AS id, categories.name AS category_name FROM $this->table 
        LEFT JOIN categories ON $this->table.category_id = categories.id";
        
        return $this->db->query($stm, get_called_class());
    }


    public function getUrl()
    {
        return 'index.php?p=product&id=' . $this->id;
    }

    public function getBySearch($search)
    {
        $stm = "SELECT * FROM $this->table WHERE name LIKE ? OR collection LIKE ? OR category LIKE ?";
        $result = "%$search%";

        return $this->db->query(
            $stm,
            get_called_class(),
            [$result, $result, $result]
        );
    }


    public function update($name, $category_id, $collection, $price, $id )
    {
        $stm = "UPDATE $this->table 
            SET name = :name, category_id = :category_id, collection = :collection, price = :price
            WHERE id = :id";

        return $this->db->nonSelect(
            $stm,
            [
                ":name" => $name,
                ":category_id" => $category_id,
                ":collection" => $collection,
                ":price" => $price,
                ":id" => $id 
            ]
        );
    }

    public function add($name, $category_id, $collection, $price )
    {
        $stm = "INSERT INTO $this->table (name, category_id, collection, price)
            VALUES (:name, :category_id, :collection, :price)";

        return $this->db->nonSelect(
            $stm,
            [
                ":name" => $name,
                ":category_id" => $category_id,
                ":collection" => $collection,
                ":price" => $price
            ]
        );
    }

    public function getCategoryName($id)
    {
        $stm = "SELECT categories.name as category_name FROM categories 
        JOIN products ON categories.id = products.category_id
        WHERE products.category_id = :id";

        $result = $this->db->query(
            $stm,
            get_called_class(),
            [
                ":id" => $id],
                true
        );

        return $result->category_name;
    }



    public function search($search){
        $value = "%" . $search . "%";

        $stm = "SELECT * FROM $this->table 
        WHERE name LIKE :name OR color LIKE :color OR collection LIKE :collection ";

        $result = $this->db->query(
            $stm,
            get_called_class(),
            [
                ":name" => $value,
                ":color"=> $value,
                ":collection"=> $value,
            ]
        );
        
        return $result ? $result : null;
    }
}





