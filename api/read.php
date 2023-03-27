<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once dirname(__DIR__) . '/config/database.php';
include_once dirname(__DIR__) . '/class/authors.php';
include_once dirname(__DIR__) . '/class/books.php';

<<<<<<< HEAD
function getData($class, $data = null) {
=======
function getData($class) {
>>>>>>> 25a5795b655cb28f883da02d9a5162fbe056580c
    $database = new Database();
    $db = $database->getConnection();

    if($class == 'authors') {
        $items = new Authors($db);
<<<<<<< HEAD
        $stmt = $items->getAuthors($data);
    }
    if($class == 'books') {
        $items = new Books($db);
        $stmt = $items->getBooks($data);
=======
        $stmt = $items->getAuthors();
    }
    if($class == 'books') {
        $items = new Books($db);
        $stmt = $items->getBooks();
>>>>>>> 25a5795b655cb28f883da02d9a5162fbe056580c
    }

    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);
    if($itemCount > 0){

        $Params = [];
        $Params["body"] = [];
        $Params["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            if($class == 'authors') {
                $e = [
                    "id" => $id,
                    "first_name" => $first_name,
                    "second_name" => $second_name,
                    "last_name" => $last_name,
                    "birthday" => $birthday
                ];
            }
            if($class == 'books') {
                $e = [
                    "id" => $id,
                    "title" => $title,
                    "author_id" => $author_id,
                    "release_date" => $release_date,
                ];
            }
            $Params["body"][] = $e;
        }
        echo json_encode($Params);
    }
    else{
        http_response_code(404);
        echo json_encode(
            ["message" => "No record found."]
        );
    }
}
<<<<<<< HEAD
=======


>>>>>>> 25a5795b655cb28f883da02d9a5162fbe056580c
?>