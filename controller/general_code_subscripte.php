<?php

require '../admin/config.php';
require '../admin/functions.php';

$connect = connect($database);

$data = subscribe($connect);

echo json_encode($data);

?>
