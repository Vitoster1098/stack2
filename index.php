<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
function getFormData($method) {

    // GET или POST: данные возвращаем как есть
    if ($method === 'GET') return $_GET;
    if ($method === 'POST') return $_POST;

    // PUT, PATCH или DELETE
    $data = [];
    $exploded = explode('&', file_get_contents('php://input'));

    foreach($exploded as $pair) {
        $item = explode('=', $pair);
        if (count($item) == 2) {
            $data[urldecode($item[0])] = urldecode($item[1]);
        }
    }

    return $data;
}

$method = $_SERVER['REQUEST_METHOD'];
$formData = getFormData($method);

$url = (isset($_GET['q'])) ? $_GET['q'] : '';
$url = rtrim($url, '/');
$urls = explode('/', $url);

$router = $urls[0]; //class type
$urlData = array_slice($urls, 1);
<<<<<<< HEAD

//get all
if($method === 'GET' && (count($urlData) !== 1 && in_array('release_date', $urlData) || count($urlData) === 0)) {
    include_once 'api/read.php';
}
//get by id
else if($method === 'GET' && (count($urlData) === 1 || count($urlData) === 2)) {
=======
//get all
if($method === 'GET' && count($urlData) === 0) {
    include_once 'api/read.php';
}
//get by id
else if($method === 'GET' && count($urlData) === 1) {
>>>>>>> 25a5795b655cb28f883da02d9a5162fbe056580c
    include_once 'api/single_read.php';
}
//create
else if($method === 'POST') {
    include_once 'api/create.php';
}
//update
else if($method === 'PUT') {
    include_once 'api/update.php';
}
//delete
else if($method === 'DELETE') {
    include_once 'api/delete.php';
}
//error
else {
    header('HTTP/1.0 400 Bad Request');
    echo json_encode([
        'error' => 'Bad Request'
    ]);
}
<<<<<<< HEAD
getData($router, $urlData);
=======
//var_dump($urlData);
getData($router);
>>>>>>> 25a5795b655cb28f883da02d9a5162fbe056580c
?>