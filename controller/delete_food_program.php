<?php 

session_start();

define('SITE_URL', 'https://appadmin.mohannad-theeb.com/');
if (isset($_SESSION['manager_email'])){
    
    
require '../admin/config.php';
require '../admin/functions.php';
require '../views/header.view.php';
require '../views/navbar.view.php'; 

$errors = '';

$connect = connect($database);
if(!$connect){
	header('Location: ' . SITE_URL . '/controller/error.php');
	} 

$id_category = cleardata($_GET['id']);

if(!$id_category){
	header('Location: ' . SITE_URL . '/controller/home.php');
}

$statement = $connect->prepare('DELETE FROM program_food WHERE id = :id');
$statement->execute(array('id' => $id_category));

header('Location: ' . SITE_URL . '/controller/food_program.php');

}else {
		header('Location: ' . SITE_URL . '/controller/login.php');		
		}


?>