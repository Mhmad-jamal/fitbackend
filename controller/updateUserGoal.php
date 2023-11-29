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
    $sentence = $connect->prepare("SELECT * FROM `users_goal` WHERE user_id = :user_id");
    $sentence->bindParam(':user_id', $user_id);
    $sentence->execute();
    
    if ($sentence->rowCount() > 0) {
        // User exists, fetch and update the data
        $user_data = $sentence->fetch(PDO::FETCH_ASSOC);
        $user_old_goal = json_decode($user_data["user_goal"], true); // true to get an associative array
    
        // Update existing values
        foreach ($user_goal as $new_value) {
            $componentId = $new_value["componentId"];
            $index = array_search($componentId, array_column($user_old_goal, 'componentId'));
    
            if ($index !== false) {
                $user_old_goal[$index]["value"] = $new_value["value"];
            } else {
                $user_old_goal[] = $new_value;
            }
        }
    }
    $query = "UPDATE `users_goal` SET `user_goal` = '$user_goal', `created_at` = NOW() WHERE `users_goal`.`user_id` LIKE '$user_id';";
    
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

