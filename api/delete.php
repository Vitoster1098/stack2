<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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
    $data = json_decode(file_get_contents("php://input"));

    if($class == 'authors') {
        $item = new Authors($db);
        $item->id = $data->id;

        if($item->deleteAuthor()){
            echo json_encode("Author deleted.");
        } else{
            echo json_encode("Author could not be deleted.");
        }
    }
    if($class == 'books') {
        $item = new Books($db);
        $item->id = $data->id;

        if($item->deleteBook()){
            echo json_encode("Book deleted.");
        } else{
            echo json_encode("Book could not be deleted.");
        }
    }




}

?>