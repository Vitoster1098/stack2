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
function getData($class, $datas = null) {
=======
function getData($class) {
>>>>>>> 25a5795b655cb28f883da02d9a5162fbe056580c
    $database = new Database();
    $db = $database->getConnection();

    $data = json_decode(file_get_contents("php://input"));
    if($class == 'authors') {
        $item = new Authors($db);

        $item->first_name = $data->first_name;
        $item->second_name = $data->second_name;
        $item->last_name = $data->last_name;
        $item->birthday = $data->birthday;

        if($item->createAuthor()) {
            echo 'Author created successfully.';
        } else{
            echo 'Author could not be created.';
        }
    }
    if($class == 'books') {
        $item = new Books($db);

        $item->title = $data->title;
        $item->author_id = $data->author_id;
        $item->release_date = $data->release_date;

        if($item->createBook()) {
            echo 'Book created successfully.';
        } else{
            echo 'Book could not be created.';
        }
    }
}
?>