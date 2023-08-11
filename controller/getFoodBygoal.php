<?php

require '../admin/config.php';
require '../admin/functions.php';

$connect = connect($database);

$data = get_food_by_goal($connect);
if($data){
$results = array(
    "sEcho" => 1,
    "response" => 200,
    "message" => 'data diet retrive succsessfully',

    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData"=>$data);
}else {
    $results = array(
        "response" => 201,
        "message" => 'user not found',
       );
}
echo json_encode($results);

?>