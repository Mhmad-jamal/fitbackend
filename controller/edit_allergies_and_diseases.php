<?php 
ob_start(); 
session_start();
if (isset($_SESSION['manager_email'])){
    
    
require '../admin/config.php';
require '../admin/functions.php';
require '../views/header.view.php';
require '../views/navbar.view.php'; 

$connect = connect($database);
if(!$connect){
	header ('Location: ' . SITE_URL . '/controller/error.php');
	}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$name = cleardata($_POST['name']);
	$id = cleardata($_POST['id']);
	$image_save = $_POST['image_save'];
	$image = $_FILES['image'];

	if (empty($image['name'])) {
		$image = $image_save;
	} else{
			$imagefile = explode(".", $_FILES["image"]["name"]);
            
			$renamefile = round(microtime(true)) . '.' . end($imagefile);
		$image_upload = '../' . $items_config['images_folder'];
		move_uploaded_file($_FILES['image']['tmp_name'], $image_upload . 'catdiet_' . $renamefile);
		$image = 'catdiet_' . $renamefile;
	}


$statment = $connect->prepare(
	'UPDATE allergies_and_diseases SET name = :name, image = :image WHERE id = :id');

$statment->execute(array(

		':name' => $name,
		':image' => $image,
		':id' => $id

		));

header('Location: ' . $_SERVER['HTTP_REFERER']);

} else{

$allergies_and_diseases_id = $_GET['id'];
    
if(empty($allergies_and_diseases_id)){
	header('Location: ' . SITE_URL . '/controller/home.php');
	}

$allergies_and_diseases = get_allergies_and_diseases_id($connect, $allergies_and_diseases_id);
    
    if (!$allergies_and_diseases){
    header('Location: ' . SITE_URL . '/controller/home.php');
}

$allergies_and_diseases = $allergies_and_diseases['0'];

}

require '../views/edit.allergies_and_diseases.view.php';
require '../views/footer.view.php';
    
} else {
		header('Location: ' . SITE_URL . '/controller/login.php');		
		}


?>