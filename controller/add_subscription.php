<?php
session_start();

define('SITE_URL', 'https://appadmin.mohannad-theeb.com/');
if (isset($_SESSION['manager_email'])){
    
    require '../admin/config.php';
    require '../admin/functions.php';	
    require '../views/header.view.php';
    require '../views/navbar.view.php';    
    $connect = connect($database);
    if(!$connect){
        header ('Location: ' . SITE_URL . '/controller/error.php');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = cleardata($_POST['name']);
        $subscription_duration = cleardata($_POST['subscription_duration']);
        $price = cleardata($_POST['price']);
    
        $statement = $connect->prepare(
            'INSERT INTO subscription (name, subscription_duration, price) VALUES (:name, :subscription_duration, :price)'
        );
    
        // Bind values using named placeholders
        $statement->bindValue(':name', $name);
        $statement->bindValue(':subscription_duration', $subscription_duration);
        $statement->bindValue(':price', $price);
    
        // Execute the prepared statement
        $statement->execute();
    
        require '../views/subscription.view.php';
    }
    require '../views/add_subscription.view.php';
    require '../views/footer.view.php';
    
} else {
    header('Location: ' . SITE_URL . '/controller/login.php');		
}
?>
