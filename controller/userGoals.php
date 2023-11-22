<?php
require '../admin/config.php';
require '../admin/functions.php';

$response = array("status" => 0, "data" => "");

$connect = connect($database);
if (!$connect) {
    $response = array("status" => 0, "data" => "Error data connect");
    die();
}
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: *");


// Debugging: Check traditional form data


// Debugging: Check raw POST data
// Use $_POST to access the data sent from React Native app
$user_id = $_POST['user_id'];
$user_email = $_POST['user_email'];
$user_name = $_POST['user_name'];
$user_goal = $_POST['user_goal'];

try {
    $stmt = $connect->prepare('INSERT INTO users_goal (user_id, user_email, user_name, user_goal) VALUES (:user_id, :user_email, :user_name, :user_goal)');
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':user_email', $user_email);
    $stmt->bindParam(':user_name', $user_name);
    $stmt->bindParam(':user_goal', $user_goal);

    $stmt->execute();

    // Set the success response.
    $response = array(
        'status' => 200,
        'message' => 'Data inserted successfully.'
    );
} catch (PDOException $e) {
    // If there's an error, set the error response.
    $response = array(
        'status' => 500,
        'message' => 'Error: ' . $e->getMessage()
    );
}

// Send the response back to the client as JSON.
header('Content-Type: application/json');
echo json_encode($response);
?>
