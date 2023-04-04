<?php

class Authors
{
    private $conn;
    private string $table_name = "authors";

    //fields
    public int $id;
    public string $first_name;
    public string $second_name;
    public string $last_name;
    public string $birthday;

    //db constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }
    //get all
    public function getAuthors($filters = null)
    {
        $sqlQuery = "SELECT `id`, `first_name`, `second_name`, `last_name`, `birthday` " .
            "FROM " . $this->table_name .
            " WHERE `id` > '-1'";

        if(in_array('first_name', $filters)) {
            $ind = array_search('first_name', $filters);

            if(isset($filters[$ind + 1])) {
                if(is_string($filters[$ind+1])) {
                    $sqlQuery .= " AND `first_name` = '" . $filters[$ind + 1] . "'";
                }
            }
        }
        if(in_array('second_name', $filters)) {
            $ind = array_search('second_name', $filters);

            if(isset($filters[$ind + 1])) {
                if(is_string($filters[$ind+1])) {
                    $sqlQuery .= " AND `second_name` = '" . $filters[$ind + 1] . "'";
                }
            }
        }
        if(in_array('last_name', $filters)) {
            $ind = array_search('last_name', $filters);

            if(isset($filters[$ind + 1])) {
                if(is_string($filters[$ind+1])) {
                    $sqlQuery .= " AND `last_name` = '" . $filters[$ind + 1] . "'";
                }
            }
        }
        if(in_array('birthday', $filters)) {
            $ind = array_search('birthday', $filters);

            if(isset($filters[$ind + 1]) && isset($filters[$ind + 2])) {
                if (strtotime($filters[$ind + 1]) && strtotime($filters[$ind + 2])) {
                    $sqlQuery .= " AND `birthday` BETWEEN DATE('" . $filters[$ind + 1] . "') AND DATE('" .
                        $filters[$ind + 2] . "')";
                }
                if ($filters[$ind + 1] == '<' || $filters[$ind + 1] == '>' && strtotime($filters[$ind + 2])) {
                    $sqlQuery .= " AND `birthday` " . $filters[$ind + 1] . " DATE('" . $filters[$ind + 2] . "')";
                }
            }
        }
        if(in_array('LIMIT', $filters)) {
            $ind = array_search('LIMIT', $filters);

            if(isset($filters[$ind + 1])) {
                if (is_numeric($filters[$ind + 1])) {
                    $sqlQuery .= " LIMIT " . $filters[$ind + 1];
                }
            }
        }#var_dump($sqlQuery);


        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    //get single
    public function getAuthorById($filters = null)
    {
        $sqlQuery = "SELECT `id`, 
            `first_name`, 
            `second_name`, 
            `last_name`, 
            `birthday` " .
            "FROM " . $this->table_name .
            " WHERE `id`= ? 
            LIMIT 1";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->first_name = $dataRow['first_name'];
        $this->second_name = $dataRow['second_name'];
        $this->last_name = $dataRow['last_name'];
        $this->birthday = $dataRow['birthday'];
    }
    //create
    public function createAuthor(): bool
    {
        $sqlQuery = "INSERT INTO ". $this->table_name .
            " SET first_name = :first_name, 
                second_name = :second_name, 
                last_name = :last_name, 
                birthday = :birthday";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->second_name = htmlspecialchars(strip_tags($this->second_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->birthday = htmlspecialchars(strip_tags($this->birthday));

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":second_name", $this->second_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":birthday", $this->birthday);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    //update
    public function updateAuthor(): bool
    {
        $sqlQuery = "UPDATE ". $this->table_name .
                    " SET first_name = :first_name, 
                        second_name = :second_name, 
                        last_name = :last_name, 
                        birthday = :birthday" .
                    " WHERE id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->second_name = htmlspecialchars(strip_tags($this->second_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->birthday = htmlspecialchars(strip_tags($this->birthday));

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":second_name", $this->second_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":birthday", $this->birthday);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    //delete
    public function deleteAuthor(): bool
    {
        $sqlQuery = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>