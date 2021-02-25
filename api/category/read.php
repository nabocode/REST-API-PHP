<?php
//Headers
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: access");
header('Content-Type: application/json; charset=UTF-8');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

//Instantiate blog category object
$category = new Category($db);

//Category Read Query
$result = $category->read();
//Get row count
$num = $result->rowCount();

//Check if any categories
if ($num > 0) {
    //Post array
    $categories_arr = array();
    $categories_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $categories_item = array(
            'id' => $id,
            'name' => $name
        );

        //Push to "data"
        array_push($categories_arr['data'], $categories_item);
    }

    //Turn to JSON & output
    echo json_encode($categories_arr);

} else {
    //No Categoriess
    echo json_encode(
        array('message' => 'No Categoriess Found')
    );
}