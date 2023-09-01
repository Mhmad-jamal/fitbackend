<?php

require '../admin/config.php';
require '../admin/functions.php';


$response = array("status" => 0, "message" => "", "data" => null);
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['db']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ( isset($_POST["user_id"] )) {
    $user_id = $_POST["user_id"]; 
    $user_data = mysqli_query($conn, "SELECT * FROM `users_goal` WHERE `user_id` LIKE '$user_id'");
    if (mysqli_num_rows($user_data) > 0) {

        $user_data_arr = mysqli_fetch_assoc($user_data);
var_dump($user_data);
    }else {
        $response["status"] = 201;
        $response["message"] = "user not found!";
    }

}