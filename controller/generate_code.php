<?php

session_start();

if (isset($_SESSION['manager_email'])){

require '../admin/config.php';
require '../admin/functions.php';	
require '../views/header.view.php';
require '../views/navbar.view.php';    
$connect = connect($database);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$code = cleardata($_POST['code']);

	$statment = $connect->prepare(
		'INSERT INTO generated_code (code) VALUES (:code)'
		);

	$statment->execute(array(
		':code' => $code,
	
		));

	header('Location:' . SITE_URL . '/controller/generate_code.php');

}
require '../views/generate_code.view.php';
require '../views/footer.view.php';
    
}else{

	header('Location: ' . SITE_URL . '/controller/login.php');		
}


?>