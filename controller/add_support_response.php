<?php
session_start();
    
    require '../admin/config.php';
    require '../admin/functions.php';	

    $connect = connect($database);
    if(!$connect){
        header ('Location: ' . SITE_URL . '/controller/error.php');
    }
    $response= array();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['support_id']) && isset($_POST['response']) ) {
        $support_id = cleardata($_POST['support_id']);
        $response = cleardata($_POST['response']);
        
        $statement = $connect->prepare(
            'UPDATE support SET response=:response WHERE id=:support_id'
        );
        
        $statement->bindParam(':support_id', $support_id, PDO::PARAM_INT);
        $statement->bindParam(':response', $response, PDO::PARAM_STR);
        
        $statement->execute();
        
        
    
        // Execute the prepared statement
   
        if ($statement) {
            header('Location: ' . SITE_URL . 'controller/support.php');
        }
    }
    else{
     echo 'Failed add response, Error occurred';
    }
    
?>
