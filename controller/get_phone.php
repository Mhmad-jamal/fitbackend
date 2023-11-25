<?php

require '../admin/config.php';
require '../admin/functions.php';

$connect = connect($database);

$data = get_phone($connect);

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData"=>$data);
echo json_encode($results);

?>
