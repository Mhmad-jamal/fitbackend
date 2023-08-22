<?php 

session_start();



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
    $start_date = cleardata($_POST['start_date']);
    $end_date = cleardata($_POST['end_date']);
    $price = cleardata($_POST['price']);

    try {
        $statement = $connect->prepare(
            'UPDATE subscription 
            SET name = :name, start_date = :start_date, end_date = :end_date, price = :price 
            WHERE id = :id'
        );

        // Bind values using named placeholders
        $statement->bindValue(':name', $name);
        $statement->bindValue(':start_date', $start_date);
        $statement->bindValue(':end_date', $end_date);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':id', $id); // Bind the id value

        // Execute the prepared statement
        $statement->execute();

        header('Location: ' . SITE_URL . '/controller/subscription.php');
        exit(); // Make sure to exit the script after redirection
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