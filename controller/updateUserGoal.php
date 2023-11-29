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

    $sentence = $conn->query("SELECT * FROM `users_goal` WHERE user_id = '$user_id'");

    if ($sentence->num_rows > 0) {
        $user_data = $sentence->fetch_assoc();
        $user_old_goal = json_decode($user_data["user_goal"], true);

        foreach ($user_goal as $new_value) {
            $componentId = $new_value["componentId"];
            $index = array_search($componentId, array_column($user_old_goal, 'componentId'));

            if ($index !== false) {
                $user_old_goal[$index]["value"] = $new_value["value"];
            } else {
                $user_old_goal[] = $new_value;
            }
        }

        $updateQuery = "UPDATE `users_goal` SET `user_goal` = '" . json_encode($user_old_goal) . "', `created_at` = NOW() WHERE `user_id` = '$user_id'";
        $user_data = $conn->query($updateQuery);

        if ($user_data) {
            $response["status"] = 200;
            $response["message"] = "User goal updated!";
        } else {
            $response["status"] = 201;
            $response["message"] = "No need to update goal or an error occurred.";
        }
    } else {
        $response["status"] = 404;
        $response["message"] = "User not found";
    }
} else {
    $response["status"] = 404;
    $response["message"] = "User ID not provided";
}

echo json_encode($response);

?>
