<?php 

session_start();

define('SITE_URL', 'https://appadmin.mohannad-theeb.com/');



if (isset($_SESSION['manager_email'])){
    
require '../admin/config.php';
require '../admin/functions.php';
require '../views/header.view.php';
require '../views/navbar.view.php'; 

$connect = connect($database);

$subscription_id = $_GET['id'];

if(empty($subscription_id)){
	header('Location: ' . SITE_URL . '/controller/.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = cleardata($_POST['id']); // Make sure to retrieve the id from the form

    $name = cleardata($_POST['name']);
    $subscription_duration = cleardata($_POST['subscription_duration']);
   
    $price = cleardata($_POST['price']);

    try {
        $statement = $connect->prepare(
            'UPDATE subscription 
            SET name = :name, subscription_duration=:subscription_duration, price = :price 
            WHERE id = :id'
        );

        // Bind values using named placeholders
        $statement->bindValue(':name', $name);
        $statement->bindValue(':subscription_duration', $subscription_duration);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':id', $id); // Bind the id value

        // Execute the prepared statement
        $statement->execute();

        require '../views/subscription.view.php';
    } catch (\PDOException $e) {
        // Handle the exception here
        echo "Error updating subscription: " . $e->getMessage();
    }



}else {
$subscription = get_subscription_ById($connect, $subscription_id);

if (!$subscription){
    header('Location: ' . SITE_URL . '/controller/home.php');
}else {
    $subscription=$subscription[0];
}







 require '../views/edit_subscription.view.php';

}
require '../views/footer.view.php';
    
}else {
	header('Location: ' . SITE_URL . '/controller/login.php');		
}


?>