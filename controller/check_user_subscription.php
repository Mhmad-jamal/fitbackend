<?php

require '../admin/config.php';
require '../admin/functions.php';

$connect = connect($database);

$data = checkUsersubscriptions($connect);
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
        "message" => 'user does not have subsecription',
       );
}
echo json_encode($results);

?>
