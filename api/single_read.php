<?php
include_once dirname(__DIR__) . '/config/database.php';
include_once dirname(__DIR__) . '/class/authors.php';
include_once dirname(__DIR__) . '/class/books.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

<<<<<<< HEAD
function getData($class, $data = null)
=======
function getData($class)
>>>>>>> 25a5795b655cb28f883da02d9a5162fbe056580c
{
    $Params = [];
    $database = new Database();
    $db = $database->getConnection();
    if ($class == 'authors') {
        $item = new Authors($db);
<<<<<<< HEAD
        $item->id = $data[0];

        $item->getAuthorById($data);
=======
        $item->id = isset($_GET['id']) ? $_GET['id'] : die();

        $item->getAuthorById();
>>>>>>> 25a5795b655cb28f883da02d9a5162fbe056580c
        if ($item->first_name != null) {
            // create array
            $Params = [
                "id" => $item->id,
                "first_name" => $item->first_name,
                "second_name" => $item->second_name,
                "last_name" => $item->last_name,
<<<<<<< HEAD
                "birthday" => $item->birthday,
                "books" => $item->books,
            ];
            http_response_code(200);
            echo json_encode($Params);
        }
        else {
            http_response_code(404);
            echo json_encode("Author not found.");
        }
    }
    else if ($class == 'books') {
        $item = new Books($db);
        #$item->id = isset($_GET['id']) ? $_GET['id'] : die();
        $item->id = $data[0];
=======
                "birthday" => $item->birthday
            ];
        }
        http_response_code(200);
        echo json_encode($Params);
    }
    else {
        http_response_code(404);
        echo json_encode("Author not found.");
    }
    if ($class == 'books') {
        $item = new Books($db);
        $item->id = isset($_GET['id']) ? $_GET['id'] : die();
>>>>>>> 25a5795b655cb28f883da02d9a5162fbe056580c

        $item->getBookById();
        if ($item->title != null) {
            // create array
            $Params = [
                "id" => $item->id,
                "title" => $item->title,
<<<<<<< HEAD
                #"author_id" => $item->author_id,
                "release_date" => $item->release_date,
                "author" => $item->author,
            ];
            http_response_code(200);
            echo json_encode($Params);
        }
        else {
            http_response_code(404);
            echo json_encode( "Book not found.");
        }
=======
                "author_id" => $item->author_id,
                "release_date" => $item->release_date,
            ];
        }
        http_response_code(200);
        echo json_encode($Params);
    }
    else {
        http_response_code(404);
        echo json_encode( "Book not found.");
>>>>>>> 25a5795b655cb28f883da02d9a5162fbe056580c
    }
}
?>