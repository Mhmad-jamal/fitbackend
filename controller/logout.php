<?php 

require '../admin/config.php';
require '../admin/functions.php';

$connect = connect($database);

    
	session_start();

define('SITE_URL', 'https://appadmin.mohannad-theeb.com/');

	session_destroy();
	$_SESSION = array ();

	header('Location: ./login.php');





?>