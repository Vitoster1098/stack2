<?php

class Authors
{
    private $conn;
    private $table_name = "authors";

    //fields
    public $id;
    public $first_name;
    public $second_name;
    public $last_name;
    public $birthday;
<<<<<<< HEAD
    public $books;
=======
>>>>>>> 25a5795b655cb28f883da02d9a5162fbe056580c

    //db constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }
    //get all
<<<<<<< HEAD
    public function getAuthors($filters = null) {
        $sqlQuery = "SELECT `id`, `first_name`, `second_name`, `last_name`, `birthday` " .
            "FROM " . $this->table_name;
            if ($filters[0] == 'title') {
                $sqlQuery = "SELECT " . $this->table_name . ".`id`, 
            " . $this->table_name . ".`first_name`, 
            " . $this->table_name . ".`second_name`, 
            " . $this->table_name . ".`last_name`, 
            " . $this->table_name . ".`birthday` " .
                    "FROM " . $this->table_name . ", books";
            }

=======
    public function getAuthors() {
        $sqlQuery = "SELECT `id`, `first_name`, `second_name`, `last_name`, `birthday` " .
            "FROM " . $this->table_name;
>>>>>>> 25a5795b655cb28f883da02d9a5162fbe056580c
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    //get single
<<<<<<< HEAD
    public function getAuthorById($filters = null) {
        $sqlQuery = "SELECT " . $this->table_name . ".`id`, "
         . $this->table_name . ".`first_name`, "
         . $this->table_name . ".`second_name`, "
         . $this->table_name . ".`last_name`, "
         . $this->table_name . ".`birthday`, "
         . "books.`title` as `books` " .
        "FROM " . $this->table_name . ", books " .
            "WHERE " . $this->table_name .".`id`= ? AND books.`author_id` = " . $this->table_name . ".`id` " .
            "LIMIT 0,1;";

        if($filters[1] == 'count') {
            $sqlQuery = "SELECT " . $this->table_name . ".`id`, "
                . $this->table_name . ".`first_name`, "
                . $this->table_name . ".`second_name`, "
                . $this->table_name . ".`last_name`, "
                . $this->table_name . ".`birthday`, "
                . "count(books.`author_id`) as `books count`" .
                "FROM " . $this->table_name . ", books " .
                "WHERE " . $this->table_name .".`id`= ? AND books.`author_id` = " . $this->table_name . ".`id` " .
                "GROUP BY books.`author_id` " .
                "LIMIT 0,1";
        }

=======
    public function getAuthorById() {
        $sqlQuery = "SELECT `id`, `first_name`, `second_name`, `last_name`, `birthday` " .
        "FROM " . $this->table_name .
            " WHERE `id`= ? " .
            "LIMIT 0,1;";
>>>>>>> 25a5795b655cb28f883da02d9a5162fbe056580c
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->first_name = $dataRow['first_name'];
        $this->second_name = $dataRow['second_name'];
        $this->last_name = $dataRow['last_name'];
        $this->birthday = $dataRow['birthday'];
<<<<<<< HEAD

        if($filters[1] == 'count') {
            $this->books = $dataRow['books count'];
        }
        else {
            $this->books = $dataRow['books'];
        }
=======
>>>>>>> 25a5795b655cb28f883da02d9a5162fbe056580c
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