<?php 

session_start();
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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name = cleardata($_POST['name']);

	$image = $_FILES['image']['tmp_name'];

	$imagefile = explode(".", $_FILES["image"]["name"]);
	$renamefile = round(microtime(true)) . '.' . end($imagefile);

	$image_upload = '../' . $items_config['images_folder'];

	move_uploaded_file($image, $image_upload . 'catdiet_' . $renamefile);

	$statment = $connect->prepare(
		'INSERT INTO allergies_and_diseases (id,name,image) VALUES (null, :name, :image)'
		);

	$statment->execute(array(
		':name' => $name,
		':image' => 'catdiet_' . $renamefile
		));

	header('Location:' . SITE_URL . '/controller/allergies_and_diseases.php');

}

require '../views/new_allergies_and_diseases.php';
require '../views/footer.view.php';
    
}else {
		header('Location: ' . SITE_URL . '/controller/login.php');		
		}


?>