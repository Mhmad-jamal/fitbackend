<?php

require '../admin/config.php';
require '../admin/functions.php';


$response = array("status" => 0, "message" => "", "data" => null);
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['db']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST["user_id"])) {
    $user_id = $_POST["user_id"]; 
    $user_goal = $_POST["user_goal"];

    // Use NOW() function to set the created_at column to the current date and time
    $query = "UPDATE `users_goal` SET `user_goal` = '$user_goal', `created_at` = NOW() WHERE `users_goal`.`id` = '$user_id';";
    
    $user_data = mysqli_query($conn, $query);

    if ($user_data) {
        // The query was successful
        $response["status"] = 200;
        $response["message"] = "User goal updated!";
    } else {
        // The query failed
        $response["status"] = 201;
        $response["message"] = "No need to update goal or an error occurred.";
    }
} else {
    $response["status"] = 404;
    $response["message"] = "User not found";
}

echo json_encode($response);

