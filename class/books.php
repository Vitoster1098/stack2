<?php
class Books
{
    private $conn;
    private string $table_name = "books";

    // поля
    public int $id;
    public string $title;
    public int $author_id;
    public string $release_date;
    public string $author;

    // конструктор для соединения с бд
    public function __construct($db)
    {
        $this->conn = $db;
    }
    //get all
    public function getBooks($filters = null) {
        $sqlQuery = "SELECT `id`, `title`, `author_id`, `release_date` FROM " . $this->table_name .
            " WHERE `id` > '-1'";

        if(in_array('title', $filters)) {
            $ind = array_search('title', $filters);

            if(isset($filters[$ind + 1])) {
                if(is_string($filters[$ind+1])) {
                    $sqlQuery .= " AND `title` = '" . $filters[$ind + 1] . "'";
                }
            }
        }
        if(in_array('release_date', $filters)) {
            $ind = array_search('release_date', $filters);

            if(isset($filters[$ind + 1]) && isset($filters[$ind + 2])) {
                if (strtotime($filters[$ind + 1]) && strtotime($filters[$ind + 2])) {
                    $sqlQuery .= " AND `release_date` BETWEEN DATE('" . $filters[$ind + 1] . "') AND DATE('" .
                        $filters[$ind + 2] . "')";
                }
                if ($filters[$ind + 1] == '<' || $filters[$ind + 1] == '>' && strtotime($filters[$ind + 2])) {
                    $sqlQuery .= " AND `release_date` " . $filters[$ind + 1] . " DATE('" . $filters[$ind + 2] . "')";
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
    public function getBookById() {
        $sqlQuery = "SELECT " . $this->table_name . ".`id`, "
          . $this->table_name . ".`title`, "
          . $this->table_name . ".`author_id`, "
          . $this->table_name . ".`release_date`, " .
            "concat(authors.`first_name`, ' ', authors.`second_name`, ' ', authors.`last_name`) as `author` " .
            "FROM " . $this->table_name .", authors " .
            "WHERE " . $this->table_name . ".`id`= ? AND " . $this->table_name . ".`author_id` = authors.`id` " .
            "LIMIT 0,1;";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $dataRow['title'];
        $this->author_id = $dataRow['author_id'];
        $this->author = $dataRow['author'];
        $this->release_date = $dataRow['release_date'];
    }
    //create
    public function createBook(): bool
    {
        $sqlQuery = "INSERT INTO ". $this->table_name .
            " SET title = :title, 
                author_id = :author_id, 
                release_date = :release_date";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->release_date = htmlspecialchars(strip_tags($this->release_date));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":author_id", $this->author_id);
        $stmt->bindParam(":release_date", $this->release_date);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    //update
    public function updateBook(): bool
    {
        $sqlQuery = "UPDATE ". $this->table_name .
            " SET title = :title, 
                author_id = :author_id, 
                release_date = :release_date" .
            " WHERE id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->release_date = htmlspecialchars(strip_tags($this->release_date));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":author_id", $this->author_id);
        $stmt->bindParam(":release_date", $this->release_date);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    //delete
    public function deleteBook(): bool
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