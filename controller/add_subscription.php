<?php
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = cleardata($_POST['name']);
        $start_date = cleardata($_POST['start_date']);
        $end_date = cleardata($_POST['end_date']);
        $price = cleardata($_POST['price']);
    
        $statement = $connect->prepare(
            'INSERT INTO subscription (name, start_date, end_date, price) VALUES (:name, :start_date, :end_date, :price)'
        );
    
        // Bind values using named placeholders
        $statement->bindValue(':name', $name);
        $statement->bindValue(':start_date', $start_date);
        $statement->bindValue(':end_date', $end_date);
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
