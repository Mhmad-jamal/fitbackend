<?php

require '../admin/config.php';
require '../admin/functions.php';

$response = array("status" => 0, "message" => "", "data" => null);

try {
    $conn = new PDO("mysql:host={$database['host']};dbname={$database['db']}", $database['user'], $database['pass']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST["user_id"])) {
        $user_id = $_POST["user_id"];
        $user_goal = $_POST["user_goal"];

        $stmt = $conn->prepare("SELECT * FROM `users_goal` WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user_data) {
            $user_old_goal = json_decode($user_data["user_goal"]);
            $user_goal = json_decode($user_goal);
            $needUpdate = null;

            foreach ($user_goal as $key => $value) {
                if ($value->componentId == 33) {
                    $needUpdate = $value->value;
                }
            }

            if (is_array($user_old_goal)) {
                foreach ($user_goal as $new_value) {
                    $componentId = $new_value->componentId;
                    $index = array_search($componentId, array_column($user_old_goal, 'componentId'));

                    if ($index !== false) {
                        $user_old_goal[$index]->value = $new_value->value;
                    } else {
                        $user_old_goal[] = $new_value;
                    }
                }

                $updateQuery = "UPDATE `users_goal` SET `user_goal` = :updated_goal, `created_at` = NOW() WHERE `user_id` = :user_id";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bindParam(':updated_goal', json_encode($user_old_goal));
                $updateStmt->bindParam(':user_id', $user_id);
                $updateStmt->execute();

                if ($updateStmt->rowCount() > 0) {
                    $response["status"] = 200;
                    $response["message"] = "User goal updated!";
                    
                    if ($needUpdate && $needUpdate > 2) {
                        $stmt = $conn->prepare("SELECT * FROM `usesr_goal_workout` WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1");
                        $stmt->bindParam(':user_id', $user_id);
                        $stmt->execute();
                        
                        // Fetch the last record
                        $lastRecord = $stmt->fetch(PDO::FETCH_ASSOC);
                      
                        if ($lastRecord) {
                            $id=$lastRecord['workout_id'];
                          
                             $workout = insert_workout($conn, $user_id, $id);
                       
                        $food = insert_Food($conn, $user_id, null);
                        }else{
                            $workout = insert_workout($conn, $user_id, null);
                       
                            $food = insert_Food($conn, $user_id, null);
                        }
                       
                    }else{
                        $updateQuery = "UPDATE `users_goal` SET  `created_at` = NOW() WHERE `user_id` = :user_id";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bindParam(':user_id', $user_id);
                $updateStmt->execute();
                $stmt = $conn->prepare("SELECT * FROM `usesr_goal_workout` WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1");
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();
                
                // Fetch the last record
                $lastRecord = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($lastRecord) {
                    $updateStmt = $conn->prepare("UPDATE `usesr_goal_workout` SET `created_at` = NOW() WHERE `user_id` = :user_id AND `id` = :record_id");
                    $updateStmt->bindParam(':user_id', $user_id);
                    $updateStmt->bindParam(':record_id', $lastRecord['id']);
                    $updateStmt->execute();
                
                
                }
                
                

                    }
                } else {
                    $response["status"] = 201;
                    $response["message"] = "No need to update goal or an error occurred";
                }
            } else {
                $response["status"] = 201;
                $response["message"] = "Error decoding existing user goal JSON";
            }
        } else {
            $response["status"] = 404;
            $response["message"] = "User not found";
        }
    } else {
        $response["status"] = 404;
        $response["message"] = "User ID not provided";
    }
} catch (PDOException $e) {
    $response["status"] = 500;
    $response["message"] = "Connection failed: " . $e->getMessage();
}

echo json_encode($response);

?>
