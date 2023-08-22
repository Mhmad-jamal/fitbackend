<?php

session_start();

if (isset($_SESSION['manager_email'])){

require '../admin/config.php';
require '../admin/functions.php';	
require '../views/header.view.php';
require '../views/navbar.view.php';    
$connect = connect($database);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['id'])) {
	$code = cleardata($_POST['code']);
	$subscription_id=cleardata($_POST["subscription_id"]);
	$statment = $connect->prepare(
		'INSERT INTO generated_code (code,subscription_id) VALUES (:code,:subscription_id)'
		);

	$statment->execute(array(
		':code' => $code,
		':subscription_id'=>$subscription_id,
	
		));

	header('Location:' . SITE_URL . '/controller/generate_code.php');

}
$subscription_lists = get_all_subscritption($connect);

require '../views/generate_code.view.php';
require '../views/footer.view.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $statement = $connect->prepare('DELETE FROM generated_code WHERE id = :id');
        $statement->execute(array('id' => $id));

        if ($statement->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } catch (\PDOException $e) {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}




    
}else{

	header('Location: ' . SITE_URL . '/controller/login.php');		
}


?>