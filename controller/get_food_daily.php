<?php

require '../admin/config.php';
require '../admin/functions.php';


$response = array("status" => 0, "message" => "", "data" => null);
$conn = new mysqli($database['host'], $database['user'], $database['pass'], $database['db']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$diet = '';
if ( isset($_POST["user_id"] )) {
     $user_id = $_POST["user_id"]; 

    $user_data = mysqli_query($conn, "SELECT * FROM `users_goal` WHERE `user_id` LIKE '$user_id'");
    if (mysqli_num_rows($user_data) > 0) {

        $user_data_arr = mysqli_fetch_assoc($user_data); // Use mysqli_fetch_assoc instead of mysqli_fetch_row
        $user_goal = json_decode($user_data_arr["user_goal"]);

        foreach ($user_goal as $key => $value) {

            if ($value->componentId == 16) {
                $diet = $value->value;
            }
        }




        if ($diet == '' || $diet == 2) {
            $response["status"] = 202;
            $response["message"] = "user dont want diet !";
        } else {
            $user_diet = mysqli_query($conn, "SELECT * FROM `users_goal_diet` WHERE `user_id` = '$user_id' ORDER BY created_time DESC LIMIT 1");

            if (mysqli_num_rows($user_diet) > 0) {
                $row = mysqli_fetch_assoc($user_diet);

                $created_time = strtotime($row['created_time']);

                $seven_days_ago = strtotime('-7 days'); // Calculate 7 days ago from now

                if ($created_time >= $seven_days_ago) {
                    $response["status"] = 200;
                    $response["message"] = "weekly not end !";
                    $response["data"] = $row;
                } else {
                    $isInsertSuccessful = insert_diet($user_id, $conn);

                    if ($isInsertSuccessful) {
                        $user_diet = mysqli_query($conn, "SELECT * FROM `users_goal_diet` WHERE `user_id` = '$user_id' ORDER BY created_time DESC LIMIT 1");
                        if (mysqli_num_rows($user_diet) > 0) {
                            $user_diet_data = mysqli_fetch_assoc($user_diet);
                            $response["status"] = 200;
                            $response["message"] = "weekly insert  !";
                            $response["data"] = $user_diet_data;
                        }
                    } else {
                        $response["status"] = 204;
                        $response["message"] = "sorry somethings wrong";
                    }
                }
            } else {
                $isInsertSuccessful = insert_diet($user_id, $conn);

                if ($isInsertSuccessful) {
                    $user_diet = mysqli_query($conn, "SELECT * FROM `users_goal_diet` WHERE `user_id` = '$user_id' ORDER BY created_time DESC LIMIT 1");
                    if (mysqli_num_rows($user_diet) > 0) {
                        $user_diet_data = mysqli_fetch_assoc($user_diet);
                        $response["status"] = 200;
                        $response["message"] = "weekly insert !";
                        $response["data"] = $user_diet_data;
                    }
                } else {
                    $response["status"] = 204;
                    $response["message"] = "sorry somethings wrong";
                }
            }
        }
    } else {
        $response["status"] = 201;
        $response["message"] = "user not found!";
    }
} else {
    $response["status"] = 201;
    $response["message"] = "user not found!";
}
function insert_diet($user_id, $conn)
{
    $days = array();

    $courses = array(
        1 => "breakfast",
        2 => "snak_1",
        3 => "lunch",
        4 => "snack_2",
        5 => "dinner"
    );

    for ($day = 1; $day <= 7; $day++) {
        $days[$day] = new stdClass();

        foreach ($courses as $course => $property) {
            $query = "SELECT diet_id FROM `diets` WHERE `course` = $course ORDER BY RAND() LIMIT 1";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $diet = mysqli_fetch_assoc($result);
                $days[$day]->$property = $diet['diet_id'];
            }
        }
    }


    $query = "INSERT INTO `users_goal_diet` (`user_id`, `day-1`, `day-2`, `day-3`, `day-4`, `day-5`, `day-6`, `day-7`)
    VALUES ('$user_id', '" . json_encode($days[1]) . "', '" . json_encode($days[2]) . "', '" . json_encode($days[3]) . "',
    '" . json_encode($days[4]) . "', '" . json_encode($days[5]) . "', '" . json_encode($days[6]) . "', '" . json_encode($days[7]) . "')";
    mysqli_query($conn, $query);
    if (
        $query
    ) {
        return true;
    } else {
        return false;
    }
}




echo json_encode($response);
$conn->close();
