<?php

require '../admin/config.php';
require '../admin/functions.php';

$connect = connect($database);

$data = get_workouts_by_goal($connect);
if($data){
$results = array(
    "sEcho" => 1,
    "status" => 200,
    "message" => 'data retrive succsessfully',

    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData"=>$data);
}else {
    $results = array(
        "status" => 201,
        "message" => 'user not found',
       );
}
echo json_encode($results);

?>
