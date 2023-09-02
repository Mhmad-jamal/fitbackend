<?php 

require '../admin/config.php';
require '../admin/functions.php';

$connect = connect($database);

    
	session_start();

	session_destroy();
	$_SESSION = array ();

	header('Location: ./login.php');





?>