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

    // Calculate the date one month ago from today
    $oneMonthAgo = date("Y-m-d", strtotime("-1 month"));

    SELECT * 
    FROM `users_goal` 
    WHERE `user_id` = '$user_id' 
          AND `created_at` >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK);
        
    $user_data = mysqli_query($conn, $query);

    if (mysqli_num_rows($user_data) > 0) {
        while ($row = mysqli_fetch_assoc($user_data)) {
            // Process the retrieved records here
            $response["status"] = 200;
            $response["message"] = "user Need update goal!";
        }
    } else {
        $response["status"] = 201;
        $response["message"] = "no need to update goal!";
    }
}else{
    $response["status"] = 404;
    $response["message"] = "user not Found";
}
echo json_encode($response);

