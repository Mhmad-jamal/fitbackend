<?php
session_start();
    
    require '../admin/config.php';
    require '../admin/functions.php';	

    $connect = connect($database);
    if(!$connect){
        header ('Location: ' . SITE_URL . '/controller/error.php');
    }
    $response= array();
    try {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id']) && isset($_POST['message'])) {
            $user_id = cleardata($_POST['user_id']);
            $message = cleardata($_POST['message']);
            
            $statement = $connect->prepare(
                'INSERT INTO support (user_id, message) VALUES (:user_id, :message)'
            );
            
            $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $statement->bindParam(':message', $message, PDO::PARAM_STR);
            
            $statement->execute();
            
            if ($statement) {
                $response = [
                    "success" => true,
                    "message" => 'Message sent successfully',
                    "status" => 200
                ];
            }
        } else {
            $response = [
                "success" => false,
                "message" => 'Fill required data',
                "status" => 201
            ];
        }
    } catch (PDOException $e) {
        // Print the exception message for debugging
    
        // Handle the exception here
        // You can log the error, generate a proper error response, etc.
        $response = [
            "success" => false,
            "message" => 'An error occurred while processing your request',
            "status" => 500
        ];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    
?>
