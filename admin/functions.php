<?php
ob_start(); 

/*--------------------*/
// App Name: WB Fit Basic/Pro
// Author: Wicombit
// Author Profile: https://codecanyon.net/user/wicombit/portfolio
/*--------------------*/

function connect($database)
{
    try {
        $connect = new PDO('mysql:host=' . $database['host'] . ';dbname=' . $database['db'], $database['user'], $database['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        return $connect;
    } catch (PDOException $e) {

        $connect = new PDO('mysql:host=localhost;dbname=mohannadtheeb_admin', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        return $connect;
    }
}

function cleardata($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function actual_page()
{

    return isset($_GET['p']) ? (int)$_GET['p'] : 1;
}

function number_pages($items_per_page, $connect)
{

    $total_places = $connect->prepare('SELECT FOUND_ROWS() AS total');
    $total_places->execute();
    $total_places = $total_places->fetch()['total'];

    $number_pages = ceil($total_places / $items_per_page);
    return $number_pages;
}

function get_user_information($connect)
{
    $sentence = $connect->query("SELECT * FROM managers WHERE manager_email = '" . $_SESSION['manager_email'] . "' LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}

function activePage($currect_page)
{
    $url_array =  explode('/', $_SERVER['REQUEST_URI']);
    $url = end($url_array);
    if ($currect_page == $url) {
        echo 'block'; //class name in css 
    }
}

function showMenu($currect_page)
{
    $url_array =  explode('/', $_SERVER['REQUEST_URI']);
    $url = end($url_array);
    if ($currect_page == $url) {
        echo 'show'; //class name in css 
    }
}

/////////////////////////////////////////////////////////////////////////////////// EXERCISES

function get_all_exercises($connect)
{
    $sentence = $connect->prepare("SELECT SQL_CALC_FOUND_ROWS exercises.*, equipments.equipment_title AS equipment_title, levels.level_title AS level_title, GROUP_CONCAT(bodyparts.bodypart_title) AS bodypart_title FROM exercises JOIN exercises_bodyparts ON exercises_bodyparts.exercise_id = exercises.exercise_id JOIN equipments ON exercises.exercise_equipment = equipments.equipment_id JOIN levels ON exercises.exercise_level = levels.level_id JOIN bodyparts ON bodyparts.bodypart_id = exercises_bodyparts.bodypart_id GROUP BY exercises.exercise_id ORDER BY exercises.exercise_id DESC");

    $sentence->execute();
    return $sentence->fetchAll(PDO::FETCH_ASSOC);
}
function get_all_code($connect)
{
    $sentence = $connect->prepare("  SELECT gc.*, s.name AS subscription_name
    FROM generated_code AS gc
    INNER JOIN subscription AS s ON gc.subscription_id = s.id
    ORDER BY gc.id DESC");

    $sentence->execute();
    return $sentence->fetchAll(PDO::FETCH_ASSOC);
}

function get_all_subscritption($connect)
{
    $sentence = $connect->prepare("SELECT * FROM `subscription` ORDER BY `subscription`.`id` DESC");

    $sentence->execute();
    return $sentence->fetchAll(PDO::FETCH_ASSOC);
}

function id_exercise($id)
{
    return (int)cleardata($id);
}

function get_exercise_per_id($connect, $id)
{
    $sentence = $connect->query("SELECT exercises.*,equipments.equipment_title AS equipment_title, levels.level_title AS level_title, GROUP_CONCAT(bodyparts.bodypart_title) AS bodypart_title FROM exercises JOIN exercises_bodyparts ON exercises_bodyparts.exercise_id = exercises.exercise_id JOIN bodyparts ON bodyparts.bodypart_id = exercises_bodyparts.bodypart_id JOIN equipments ON exercises.exercise_equipment = equipments.equipment_id JOIN levels ON exercises.exercise_level = levels.level_id WHERE exercises.exercise_id = $id GROUP BY exercises.exercise_id LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}
function get_all_place($connect)
{
    $sentence = $connect->query("SELECT * FROM `place`");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}
function get_all_gender($connect)
{
    $sentence = $connect->query("SELECT * FROM `gender`");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}


function number_exercises($connect)
{

    $total_numbers = $connect->prepare('SELECT * FROM exercises');
    $total_numbers->execute(array());
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function selected_exercises1($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT exercises.exercise_title, exercises.exercise_id, exercises.exercise_image FROM exercises JOIN we_day1 ON we_day1.exercise_id = exercises.exercise_id JOIN workouts ON we_day1.workout_id = ? GROUP BY we_day1.exercise_id ORDER BY we_day1.eorder ASC');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}

function not_selected_exercises1($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT exercises.exercise_title, exercises.exercise_id, exercises.exercise_image FROM exercises WHERE exercises.exercise_id NOT IN (SELECT we_day1.exercise_id FROM we_day1 WHERE we_day1.workout_id = ? GROUP BY we_day1.exercise_id)');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}

function selected_exercises2($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT exercises.exercise_title, exercises.exercise_id, exercises.exercise_image FROM exercises JOIN we_day2 ON we_day2.exercise_id = exercises.exercise_id JOIN workouts ON we_day2.workout_id = ? GROUP BY we_day2.exercise_id ORDER BY we_day2.eorder ASC');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}

function not_selected_exercises2($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT exercises.exercise_title, exercises.exercise_id, exercises.exercise_image FROM exercises WHERE exercises.exercise_id NOT IN (SELECT we_day2.exercise_id FROM we_day2 WHERE we_day2.workout_id = ? GROUP BY we_day2.exercise_id)');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}

function selected_exercises3($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT exercises.exercise_title, exercises.exercise_id, exercises.exercise_image FROM exercises JOIN we_day3 ON we_day3.exercise_id = exercises.exercise_id JOIN workouts ON we_day3.workout_id = ? GROUP BY we_day3.exercise_id ORDER BY we_day3.eorder ASC');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}

function not_selected_exercises3($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT exercises.exercise_title, exercises.exercise_id, exercises.exercise_image FROM exercises WHERE exercises.exercise_id NOT IN (SELECT we_day3.exercise_id FROM we_day3 WHERE we_day3.workout_id = ? GROUP BY we_day3.exercise_id)');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}

function selected_exercises4($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT exercises.exercise_title, exercises.exercise_id, exercises.exercise_image FROM exercises JOIN we_day4 ON we_day4.exercise_id = exercises.exercise_id JOIN workouts ON we_day4.workout_id = ? GROUP BY we_day4.exercise_id ORDER BY we_day4.eorder ASC');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}

function not_selected_exercises4($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT exercises.exercise_title, exercises.exercise_id, exercises.exercise_image FROM exercises WHERE exercises.exercise_id NOT IN (SELECT we_day4.exercise_id FROM we_day4 WHERE we_day4.workout_id = ? GROUP BY we_day4.exercise_id)');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}

function selected_exercises5($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT exercises.exercise_title, exercises.exercise_id, exercises.exercise_image FROM exercises JOIN we_day5 ON we_day5.exercise_id = exercises.exercise_id JOIN workouts ON we_day5.workout_id = ? GROUP BY we_day5.exercise_id ORDER BY we_day5.eorder ASC');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}

function not_selected_exercises5($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT exercises.exercise_title, exercises.exercise_id, exercises.exercise_image FROM exercises WHERE exercises.exercise_id NOT IN (SELECT we_day5.exercise_id FROM we_day5 WHERE we_day5.workout_id = ? GROUP BY we_day5.exercise_id)');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}

function selected_exercises6($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT exercises.exercise_title, exercises.exercise_id, exercises.exercise_image FROM exercises JOIN we_day6 ON we_day6.exercise_id = exercises.exercise_id JOIN workouts ON we_day6.workout_id = ? GROUP BY we_day6.exercise_id ORDER BY we_day6.eorder ASC');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}

function not_selected_exercises6($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT exercises.exercise_title, exercises.exercise_id, exercises.exercise_image FROM exercises WHERE exercises.exercise_id NOT IN (SELECT we_day6.exercise_id FROM we_day6 WHERE we_day6.workout_id = ? GROUP BY we_day6.exercise_id)');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}

function selected_exercises7($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT exercises.exercise_title, exercises.exercise_id, exercises.exercise_image FROM exercises JOIN we_day7 ON we_day7.exercise_id = exercises.exercise_id JOIN workouts ON we_day7.workout_id = ? GROUP BY we_day7.exercise_id ORDER BY we_day7.eorder ASC');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}

function not_selected_exercises7($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT exercises.exercise_title, exercises.exercise_id, exercises.exercise_image FROM exercises WHERE exercises.exercise_id NOT IN (SELECT we_day7.exercise_id FROM we_day7 WHERE we_day7.workout_id = ? GROUP BY we_day7.exercise_id)');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}

function get_exercises_list($connect)
{

    $sentence = $connect->prepare('SELECT
    exercises.*,
    GROUP_CONCAT(bodyparts.bodypart_title) AS bodypart_title,
    levels.level_title
FROM
    exercises
JOIN
    exercises_bodyparts ON exercises_bodyparts.exercise_id = exercises.exercise_id
JOIN
    bodyparts ON bodyparts.bodypart_id = exercises_bodyparts.bodypart_id
JOIN
    levels ON levels.level_id = exercises.exercise_level -- Include the JOIN for levels
GROUP BY
    exercises.exercise_id;
');
    $sentence->execute(array());
    return $sentence->fetchAll();
}

function insert_workout($connect, $user_id, $prev_id)
{

    $gender = '';
    $primary_goal = '';
    $place = '';
    $level = '';
    $sentence = $connect->prepare("SELECT * FROM `users_goal` WHERE user_id = '$user_id'");
    $sentence->execute();

    if ($sentence->rowCount() > 0) {
        $user_data = $sentence->fetch(PDO::FETCH_ASSOC);
        $user_goal = json_decode($user_data["user_goal"]);
if(count($user_goal)>0){
        foreach ($user_goal as $key => $value) {
            if ($value->componentId == 1) {
                $gender = $value->value;
            } elseif ($value->componentId == 2) {
                $primary_goal = $value->value;
            } elseif ($value->componentId == 3) {
                $place = $value->value;
            } elseif ($value->componentId == 4) {
                $level = $value->value;
            }
        }
    
        if ($gender == '' || $primary_goal == '' || $place == '' || $level == '') {

            return false;
        }


        $Workout_id = '';
        if ($prev_id != null) {
            $sentence = $connect->prepare("SELECT workouts.*, goals.goal_title AS goal_title, levels.level_title AS level_title, equipments.equipment_title AS equipment_title, bodyparts.bodypart_title AS bodypart_title FROM workouts,goals,levels,equipments,bodyparts WHERE workouts.workout_gender='$gender' AND workout_goal='$primary_goal' AND  workout_place='$place' AND workout_level='$level' AND workouts.workout_id !='$prev_id' AND workouts.workout_goal = goals.goal_id AND workouts.workout_level = levels.level_id AND workouts.workout_equipment = equipments.equipment_id AND workouts.workout_bodypart = bodyparts.bodypart_id ORDER BY RAND() LIMIT 1");

            $sentence->execute();
        } else {
            $sentence = $connect->prepare("SELECT workouts.*, goals.goal_title AS goal_title, levels.level_title AS level_title, equipments.equipment_title AS equipment_title, bodyparts.bodypart_title AS bodypart_title FROM workouts,goals,levels,equipments,bodyparts WHERE workouts.workout_gender='$gender' AND workout_goal='$primary_goal' AND  workout_place='$place' AND workout_level='$level' AND workouts.workout_goal = goals.goal_id AND workouts.workout_level = levels.level_id AND workouts.workout_equipment = equipments.equipment_id AND workouts.workout_bodypart = bodyparts.bodypart_id ORDER BY RAND() limit 1");
            $sentence->execute();
        }
        $Workout_data = $sentence->fetchAll();

        if (count($Workout_data) > 0) {
            $Workout_id = $Workout_data[0]['workout_id'];
            $statement = $connect->prepare(
                'INSERT INTO usesr_goal_workout (user_id, workout_id) VALUES (:user_id, :workout_id)'
            );

            $insertResult = $statement->execute(array(
                ':user_id' => $user_id,
                ':workout_id' => $Workout_id,
            ));
        } else {
            $sentence = $connect->prepare("SELECT workouts.*, goals.goal_title AS goal_title, levels.level_title AS level_title, equipments.equipment_title AS equipment_title, bodyparts.bodypart_title AS bodypart_title FROM workouts,goals,levels,equipments,bodyparts WHERE workouts.workout_gender='$gender' || workout_goal='$primary_goal' ||  workout_place='$place' || workout_level='$level' || workouts.workout_goal = goals.goal_id AND workouts.workout_level = levels.level_id AND workouts.workout_equipment = equipments.equipment_id AND workouts.workout_bodypart = bodyparts.bodypart_id ORDER BY RAND() limit 1");
            $sentence->execute();
            $Workout_data = $sentence->fetchAll();
            if (count($Workout_data) > 0) {

            $Workout_id = $Workout_data[0]['workout_id'];
            $statement = $connect->prepare(
                'INSERT INTO usesr_goal_workout (user_id, workout_id) VALUES (:user_id, :workout_id)'
            );

            $insertResult = $statement->execute(array(
                ':user_id' => $user_id,
                ':workout_id' => $Workout_id,
            ));
        }else {
            return false;
        }
        }


        if ($insertResult) {
            return $Workout_id;
        } else {
            return false;
        }
    }else {
        $sentence = $connect->prepare("SELECT workouts.*, goals.goal_title AS goal_title, levels.level_title AS level_title, equipments.equipment_title AS equipment_title, bodyparts.bodypart_title AS bodypart_title FROM workouts,goals,levels,equipments,bodyparts WHERE workouts.workout_gender='$gender' || workout_goal='$primary_goal' ||  workout_place='$place' || workout_level='$level' || workouts.workout_goal = goals.goal_id AND workouts.workout_level = levels.level_id AND workouts.workout_equipment = equipments.equipment_id AND workouts.workout_bodypart = bodyparts.bodypart_id ORDER BY RAND() limit 1");
            $sentence->execute();
            $Workout_data = $sentence->fetchAll();
            if (count($Workout_data) > 0) {

            $Workout_id = $Workout_data[0]['workout_id'];
            $statement = $connect->prepare(
                'INSERT INTO usesr_goal_workout (user_id, workout_id) VALUES (:user_id, :workout_id)'
            );

            $insertResult = $statement->execute(array(
                ':user_id' => $user_id,
                ':workout_id' => $Workout_id,
            ));
        }}
    }
}
function get_workouts_by_goal($connect)
{

    $user_id = $_POST["user_id"];
    if ($user_id) {
        $sentence = $connect->prepare("SELECT * FROM `users_goal` WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1");
        $sentence->execute();


        if ($sentence->rowCount() > 0) {

            $sentence = $connect->prepare("SELECT * FROM `usesr_goal_workout` WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1");
            $sentence->execute();

            if ($sentence->rowCount() > 0) {

                $last_record = $sentence->fetch(PDO::FETCH_ASSOC);


                $timestamp_from_db = strtotime($last_record['created_at']);
                $today = strtotime(date('Y-m-d'));
                $seven_days_ago = strtotime('-7 days', $today); // Calculate 7 days ago
                
                $workout_id = $last_record["workout_id"];
                if ($timestamp_from_db >= $seven_days_ago) {

                    $result = get_workout_per_id($connect, $workout_id);
                } else {

                    $result = insert_workout($connect, $user_id, $workout_id);
                    if ($result) {
                        $result = get_workout_per_id($connect, $result);
                    }
                }
            } else {
                $result = insert_workout($connect, $user_id, null);
                if ($result) {
                    $result = get_workout_per_id($connect, $result);
                }
            }
            return $result;
        } else {

            return false;
        }
    } else {
        return false;
    }
}
function insert_Food($connect, $user_id, $prev_id)
{
    $user_id = $_POST['user_id'];
    $diet = '';
    $primary_goal = '';

    $sentence = $connect->prepare("SELECT * FROM `users_goal` WHERE user_id = '$user_id'");
    $sentence->execute();

    if ($sentence->rowCount() > 0) {
        $user_data = $sentence->fetch(PDO::FETCH_ASSOC);

        $user_goal = json_decode($user_data["user_goal"]);
$bmi=0;
$weight=0;
$Allergies=[];
$calories=0;
$food_category=[];
        foreach ($user_goal as $key => $value) {

            if ($value->componentId == "bmi") {
                $bmi=$value->value;
            }
            if ($value->componentId == "weight") {
                $weight=$value->value;
            }
            if ($value->componentId == "15") {
                $Allergies=$value->value;
            } if ($value->componentId == "18") {
                $food_category=$value->value;
            }
        }
        if($bmi==0 || $weight==0 ){
            return false;

        }
       
        if ($bmi > 40) {
            $calories = $weight * 15;
        } elseif ($bmi <= 40 && $bmi > 30) {
            $calories = $weight * 20;
        } elseif ($bmi <= 30 && $bmi > 25) {
            $calories = $weight * 25;
        } elseif ($bmi <= 25 && $bmi > 18) {
            $calories = $weight * 30;
        } elseif($bmi<18) {
            $calories = $weight * 50;

        }
       
        
        if (count($food_category) == 0 ) {
         
           return false;

        }
        



        $diet_id = '';
        $minCalories = ((int)$calories - 100);
        $maxCalories = ((int)$calories + 100);
        if ($prev_id != null) {

            $food_categoryids = implode(",", $food_category);

            $AllergiesJSON = json_encode($Allergies);
            
            $sentence = $connect->prepare("SELECT * FROM program_food
                            WHERE calories BETWEEN $minCalories AND $maxCalories
                            AND JSON_CONTAINS(Allergies, :userAllergies)
                            AND category_id IN ($food_categoryids) 
                            AND id !=$prev_id
                            ORDER BY RAND() 
                            LIMIT 1");
            
            $sentence->bindParam(':userAllergies', $AllergiesJSON, PDO::PARAM_STR);
            $sentence->execute();
        } else {
            $food_categoryids = implode(",", $food_category);

            $AllergiesJSON = json_encode($Allergies);
            
            $sentence = $connect->prepare("SELECT * FROM program_food
                            WHERE calories BETWEEN $minCalories AND $maxCalories
                            AND JSON_CONTAINS(Allergies, :userAllergies)
                            AND category_id IN ($food_categoryids)
                            ORDER BY RAND() 
                            LIMIT 1");
            
            $sentence->bindParam(':userAllergies', $AllergiesJSON, PDO::PARAM_STR);
            $sentence->execute();
        }
       
        
        $program = $sentence->fetchAll();
       
        
        
        if (count($program) > 0) {

            $program_id = $program[0]['id'];
        } else {
            return false;
        }
       
        $statement = $connect->prepare(
            'INSERT INTO users_goal_diet (user_id, program_id) VALUES (:user_id, :program_id)'
        );

        $insertResult = $statement->execute(array(
            ':user_id' => $user_id,
            ':program_id' => $program_id,
        ));

        if ($insertResult) {
            return $program_id;
        } else {
            return false;
        }
    }
}
function get_food_by_goal($connect)
{
    $user_id = $_POST["user_id"];


    $sentence = $connect->prepare("SELECT * FROM `users_goal` WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1");
    $sentence->execute();
    if ($sentence->rowCount() > 0) {


        $sentence = $connect->prepare("SELECT * FROM `users_goal_diet` WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1");
        $sentence->execute();

        if ($sentence->rowCount() > 0) {
            $last_record = $sentence->fetch(PDO::FETCH_ASSOC);
            $timestamp_from_db = strtotime($last_record['created_at']);

            $today = strtotime(date('Y-m-d'));
          
            $seven_days_ago = strtotime('-7 days', $today); // Calculate 7 days ago
            $program_id = $last_record["program_id"];
          

            if ($timestamp_from_db > $seven_days_ago) {
                $result = get_food_program_by_id_mobile($connect, $program_id);
            } else {
                $result = insert_Food($connect, $user_id, $program_id);
                if ($result) {
                  
                    $result = get_food_program_by_id_mobile($connect, $result);
                    
                }
            }
        } else {
            $result = insert_Food($connect, $user_id, null);
          
            if ($result) {
                $result = get_food_program_by_id_mobile($connect, $result);
            }
        }
        return $result;
    } else {
       
        return false;
    }
}
function checkUsersubscriptions($connect)
{
    if (isset($_POST["user_id"])) {
        $user_id = $_POST["user_id"];
        $sentence = $connect->prepare("SELECT us.*, s.subscription_duration FROM `user_subscription` us
        INNER JOIN `subscription` s ON us.subscription_id = s.id
        WHERE us.user_id = :user_id
        ORDER BY us.created_at DESC
        LIMIT 1");

        $sentence->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $sentence->execute();

        $row_count = $sentence->rowCount(); 
       
        // Get the number of rows
        if ($row_count > 0) {
            $subscription = $sentence->fetchAll();
          
            $subscription_duration = $subscription[0]["subscription_duration"];
            $subscription_date = $subscription[0]["date"];

            $subscription_status = "Expired"; // Default status


            // Calculate the expiration date
            $subscription_duration = $subscription[0]['subscription_duration'];
            $expiration_date = date("Y-m-d", strtotime($subscription_date . "+$subscription_duration months"));

            $current_date = date("Y-m-d");
            if ($expiration_date >= $current_date) {
                $subscription_status = "Active";
                $response = array("status" => 200, "message" => "user active ");
            } else {
                $response = array("status" => 202, "message" => "Sorry your subscription is ended ");
            }

            // Update the subscription details
            $subscription[0]["subscription_expiration"] = $expiration_date;
            $subscription[0]["subscription_status"] = $subscription_status;

        } else {
            $response = array("status" => 201, "message" => "join now");
        }
    } else {
        $response = array("status" => 404, "message" => "user not found");
    }
    return $response;

}
function subscribe($connect)
{
    $response = array();

    if (isset($_POST["user_id"])) {
        $user_id = $_POST["user_id"];

        if (isset($_POST["general_code"])) {
            $general_code = $_POST["general_code"];
            $payment_method = "code";
            $query = "
            SELECT gc.id AS generated_code_id, s.id AS subscription_id, gc.*, s.*
            FROM generated_code gc
            INNER JOIN subscription s ON gc.subscription_id = s.id
            WHERE gc.code = :general_code
            
            ";
            $sentence = $connect->prepare($query);
            $sentence->bindParam(':general_code', $general_code, PDO::PARAM_STR);
            $sentence->execute();

            $row_count = $sentence->rowCount(); // Get the number of rows

            if ($row_count > 0) {
                $codedata = $sentence->fetchAll(PDO::FETCH_ASSOC)[0];
                if ($codedata["status"] == 0) {
                    $subscription_id = $codedata["subscription_id"];
                    $generated_code=$codedata["code"];
                    $currentDate = date('Y-m-d');

                    try {
                        $statement = $connect->prepare(
                            'INSERT INTO user_subscription (user_id, subscription_id, payment_method, generated_code, date) VALUES (:user_id, :subscription_id, :payment_method, :generated_code, :current_date)'
                        );
                    
                        $insertResult = $statement->execute(array(
                            ':user_id' => $user_id,
                            ':subscription_id' => $subscription_id,
                            ':current_date' => $currentDate,
                            ':payment_method' => $payment_method,
                            ':generated_code' => $generated_code,
                        ));
                        if ($insertResult) {
                            $idToUpdate = $codedata["generated_code_id"]; // Replace with the actual ID you want to update
    
                            $statement = $connect->prepare("
                        UPDATE generated_code
                         SET status = 1
                         WHERE id = :id_to_update
                            ");
    
                            $statement->bindParam(':id_to_update', $idToUpdate, PDO::PARAM_INT);
                            $updateResult = $statement->execute();
    
                            if ($updateResult) {
                                $response = array("status" => 200, "message" => "subscription updated succsessfuly add", "data" => $codedata);
    
                            } else {
                            }
                        } else {
                            // Insertion failed
                            $response = array("status" => 500, "message" => "insertion error");
                        }
                    } catch (PDOException $e) {
                        // Handle the exception (log or send an appropriate response)
                        echo "Database error: " . $e->getMessage();
                    }
                    
                   

                   
                } else {
                    $response = array("status" => 201, "message" => "Code used before", "data" => $codedata);
                }
            } else {
                $response = array("status" => 404, "message" => "invalid code");
            }
        } else {
            $response = array("status" => 405, "message" => "general Code undefined");
        }
    } else {
        $response = array("status" => 406, "message" => "user id undefined");
    }

    return $response;
}

function get_all_workouts($connect)
{

    $sentence = $connect->prepare("SELECT workouts.*, goals.goal_title AS goal_title, levels.level_title AS level_title, equipments.equipment_title AS equipment_title, bodyparts.bodypart_title AS bodypart_title FROM workouts,goals,levels,equipments,bodyparts WHERE workouts.workout_goal = goals.goal_id AND workouts.workout_level = levels.level_id AND workouts.workout_equipment = equipments.equipment_id AND workouts.workout_bodypart = bodyparts.bodypart_id ORDER BY workout_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}
function get_phone($connect)
{

    $sentence = $connect->prepare("SELECT * FROM `contact_number`");
    $sentence->execute();
    return $sentence->fetchAll();
}
function get_all_program_food($connect)
{

    $sentence = $connect->prepare("SELECT program_food.*, categories.category_title AS category_name 
    FROM program_food 
    JOIN categories ON program_food.category_id = categories.category_id 
    ORDER BY program_food.id DESC");
$sentence->execute();
    return $sentence->fetchAll();
}
function id_workout($id_workout)
{
    return (int)cleardata($id_workout);
}

function get_workout_per_id($connect, $id_workout)
{
    $sentence = $connect->query("SELECT workouts.*, goals.goal_title AS goal_title, levels.level_title AS level_title, equipments.equipment_title AS equipment_title, bodyparts.bodypart_title AS bodypart_title FROM workouts,goals,levels,equipments,bodyparts WHERE workouts.workout_goal = goals.goal_id AND workouts.workout_level = levels.level_id AND workouts.workout_equipment = equipments.equipment_id AND workouts.workout_bodypart = bodyparts.bodypart_id AND workout_id = $id_workout LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}
function get_food_program_by_id($connect, $id)
{
    $sentence = $connect->query("SELECT * FROM program_food  WHERE id =$id LIMIT 1");
    $sentence = $sentence->fetchAll();

    return ($sentence) ? $sentence : false;

}
function get_food_program_by_id_mobile($connect, $id)
{
    // Assuming $id is validated and sanitized
    $query = "SELECT program_food.*, categories.category_title AS category_title, 
              categories.category_image AS category_image
              FROM program_food
              LEFT JOIN categories ON program_food.category_id = categories.category_id
              WHERE program_food.id = :id
              LIMIT 1";

    $stmt = $connect->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $program = $stmt->fetch(PDO::FETCH_ASSOC);
   
    if($program){
        
        $program_food=json_decode($program["program"]);
$day1_values = isset($program_food->day1) ? json_decode($program_food->day1, true) : [];
$day2_values = isset($program_food->day2) ? json_decode($program_food->day2, true) : [];
$day3_values = isset($program_food->day3) ? json_decode($program_food->day3, true) : [];
$day4_values = isset($program_food->day4) ? json_decode($program_food->day4, true) : [];
$day5_values = isset($program_food->day5) ? json_decode($program_food->day5, true) : [];
$day6_values = isset($program_food->day6) ? json_decode($program_food->day6, true) : [];
$day7_values = isset($program_food->day7) ? json_decode($program_food->day7, true) : [];
$diets_data_day1 = [];

foreach ($day1_values as $diet_id) {
    // Fetch data for each ID from the "diets" table
    $diet_data = get_diet_per_id($connect, $diet_id);
    
    // Add the fetched data to the array
    $diets_data_day1[] = $diet_data;
}

$diets_data_day2 = [];
foreach ($day2_values as $diet_id) {
    // Fetch data for each ID from the "diets" table
    $diet_data = get_diet_per_id($connect, $diet_id);
    
    // Add the fetched data to the array
    $diets_data_day2[] = $diet_data;
}
$diets_data_day3 = [];
foreach ($day2_values as $diet_id) {
    // Fetch data for each ID from the "diets" table
    $diet_data = get_diet_per_id($connect, $diet_id);
    
    // Add the fetched data to the array
    $diets_data_day3[] = $diet_data;
}

$diets_data_day4 = [];
foreach ($day4_values as $diet_id) {
    // Fetch data for each ID from the "diets" table
    $diet_data = get_diet_per_id($connect, $diet_id);
    
    // Add the fetched data to the array
    $diets_data_day4[] = $diet_data;
}


$diets_data_day5 = [];
foreach ($day5_values as $diet_id) {
    // Fetch data for each ID from the "diets" table
    $diet_data = get_diet_per_id($connect, $diet_id);
    
    // Add the fetched data to the array
    $diets_data_day5[] = $diet_data;
}
$diets_data_day6 = [];
foreach ($day6_values as $diet_id) {
    // Fetch data for each ID from the "diets" table
    $diet_data = get_diet_per_id($connect, $diet_id);
    
    // Add the fetched data to the array
    $diets_data_day6[] = $diet_data;
}
$diets_data_day7 = [];
foreach ($day7_values as $diet_id) {
    // Fetch data for each ID from the "diets" table
    $diet_data = get_diet_per_id($connect, $diet_id);
    
    // Add the fetched data to the array
    $diets_data_day7[] = $diet_data;
}
$program["diets_data_day1"]=$diets_data_day1;
$program["diets_data_day2"]=$diets_data_day2;
$program["diets_data_day3"]=$diets_data_day3;
$program["diets_data_day4"]=$diets_data_day4;
$program["diets_data_day5"]=$diets_data_day5;
$program["diets_data_day6"]=$diets_data_day6;
$program["diets_data_day7"]=$diets_data_day7;
return $program;

    }else {
        return false;
    }
}


function number_workouts($connect)
{

    $total_numbers = $connect->prepare('SELECT * FROM workouts');
    $total_numbers->execute(array());
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function number_workouts_by_user($connect, $id_user)
{

    $total_numbers = $connect->prepare('SELECT * FROM workouts_users WHERE ws_user = "' . $id_user . '"');
    $total_numbers->execute(array());
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}


function get_workouts_by_user($connect, $id_user)
{

    $sentence = $connect->prepare("SELECT * FROM workouts WHERE workout_id IN (SELECT workouts_users.ws_workout FROM workouts_users WHERE ws_user = '" . $id_user . "') ORDER BY workout_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}

/////////////////////////////////////////////////////////////////////////////////// POSTS

function get_all_posts($connect)
{

    $sentence = $connect->prepare("SELECT posts.*,tags.tag_title AS tag_title FROM posts,tags WHERE posts.post_tag = tags.tag_id ORDER BY post_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}



function get_all_supports($connect)
{

    $sentence = $connect->prepare("SELECT support.*, users_goal.user_name AS user FROM support JOIN users_goal ON users_goal.user_id = support.user_id ORDER BY support.id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}
function get_all_supports_by_userId($connect)
{
    $user_id=$_POST["user_id"];
    $sentence = $connect->prepare("SELECT * FROM support WHERE user_id = :user_id ORDER BY id DESC");
    
    $sentence->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    
    $sentence->execute();
    
    return $sentence->fetchAll();
}



function id_post($id_post)
{
    return (int)cleardata($id_post);
}

function get_post_per_id($connect, $id_post)
{
    $sentence = $connect->query("SELECT posts.*,tags.tag_title AS tag_title FROM posts,tags WHERE post_id = $id_post AND posts.post_tag = tags.tag_id LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}

function number_posts($connect)
{

    $total_numbers = $connect->prepare('SELECT * FROM posts');
    $total_numbers->execute(array());
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

/////////////////////////////////////////////////////////////////////////////////// PRODUCTS

function get_all_products($connect)
{

    $sentence = $connect->prepare("SELECT products.*,types.type_title AS type_title FROM products,types WHERE products.product_type = types.type_id ORDER BY product_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}

function id_product($id_product)
{
    return (int)cleardata($id_product);
}

function get_product_per_id($connect, $id_product)
{
    $sentence = $connect->query("SELECT products.*,types.type_title AS type_title FROM products,types WHERE product_id = $id_product AND products.product_type = types.type_id LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}

function number_products($connect)
{

    $total_numbers = $connect->prepare('SELECT * FROM products');
    $total_numbers->execute(array());
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

/////////////////////////////////////////////////////////////////////////////////// DIETS

function get_all_diets($connect)
{

    $sentence = $connect->prepare("SELECT * from diets ORDER BY diet_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}

function id_diet($id_diet)
{
    return (int)cleardata($id_diet);
}

function get_diet_per_id($connect, $id_diet)
{
    $sentence = $connect->query("SELECT  * from diets WHERE diet_id = $id_diet  LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}

function number_diets($connect)
{

    $total_numbers = $connect->prepare('SELECT * FROM diets');
    $total_numbers->execute(array());
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function number_diets_by_user($connect, $id_user)
{

    $total_numbers = $connect->prepare('SELECT * FROM diets_users WHERE du_user = "' . $id_user . '"');
    $total_numbers->execute(array());
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function get_diets_by_user($connect, $id_user)
{

    $sentence = $connect->prepare("SELECT * FROM program_food WHERE id IN (SELECT diets_users.du_diet FROM diets_users WHERE du_user = '" . $id_user . "') ORDER BY id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}

/////////////////////////////////////////////////////////////////////////////////// EQUIPMENTS

function get_all_equipments($connect)
{

    $sentence = $connect->prepare("SELECT * FROM equipments ORDER BY equipment_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}

function id_equipment($id_equipment)
{
    return (int)cleardata($id_equipment);
}

function get_equipment_per_id($connect, $id_equipment)
{
    $sentence = $connect->query("SELECT * FROM equipments WHERE equipment_id = $id_equipment LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}

function number_equipments($connect)
{

    $total_numbers = $connect->prepare('SELECT * FROM equipments');
    $total_numbers->execute(array());
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

/////////////////////////////////////////////////////////////////////////////////// LEVELS

function get_all_levels($connect)
{

    $sentence = $connect->prepare("SELECT * FROM levels ORDER BY level_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}

function id_level($id_level)
{
    return (int)cleardata($id_level);
}

function get_level_per_id($connect, $id_level)
{
    $sentence = $connect->query("SELECT * FROM levels WHERE level_id = $id_level LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}

function number_levels($connect)
{

    $total_numbers = $connect->prepare('SELECT * FROM levels');
    $total_numbers->execute(array());
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

/////////////////////////////////////////////////////////////////////////////////// TYPES

function get_all_types($connect)
{

    $sentence = $connect->prepare("SELECT * FROM types ORDER BY type_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}

function id_type($id_type)
{
    return (int)cleardata($id_type);
}

function get_type_per_id($connect, $id_type)
{
    $sentence = $connect->query("SELECT * FROM types WHERE type_id = $id_type LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}
function get_subscription_ById($connect, $id)
{
    $sentence = $connect->query("SELECT * FROM subscription WHERE id = $id LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}

function number_types($connect)
{

    $total_numbers = $connect->prepare('SELECT * FROM types');
    $total_numbers->execute(array());
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

/////////////////////////////////////////////////////////////////////////////////// CATEGORIES

function get_all_categories($connect)
{

    $sentence = $connect->prepare("SELECT * FROM categories ORDER BY category_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}
function get_allergies_and_diseases($connect)
{

    $sentence = $connect->prepare("SELECT * FROM allergies_and_diseases ORDER BY id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}
function id_category($id_category)
{
    return (int)cleardata($id_category);
}

function get_category_per_id($connect, $id_category)
{
    $sentence = $connect->query("SELECT * FROM categories WHERE category_id = $id_category LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}
function get_allergies_and_diseases_id($connect, $id)
{
    $sentence = $connect->query("SELECT * FROM allergies_and_diseases WHERE id = $id LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}

function number_categories($connect)
{

    $total_numbers = $connect->prepare('SELECT * FROM categories');
    $total_numbers->execute(array());
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

/////////////////////////////////////////////////////////////////////////////////// MANAGERS

function get_all_managers($connect)
{

    $sentence = $connect->prepare("SELECT * FROM managers ORDER BY manager_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}

function id_manager($id_manager)
{
    return (int)cleardata($id_manager);
}

function get_manager_per_id($connect, $id_manager)
{
    $sentence = $connect->query("SELECT * FROM managers WHERE manager_id = $id_manager LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}


/////////////////////////////////////////////////////////////////////////////////// TAGS

function get_all_tags($connect)
{

    $sentence = $connect->prepare("SELECT * FROM tags ORDER BY tag_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}

function id_tag($id_tag)
{
    return (int)cleardata($id_tag);
}

function get_tag_per_id($connect, $id_tag)
{
    $sentence = $connect->query("SELECT * FROM tags WHERE tag_id = $id_tag LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}

function number_tags($connect)
{

    $total_numbers = $connect->prepare('SELECT * FROM tags');
    $total_numbers->execute(array());
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

/////////////////////////////////////////////////////////////////////////////////// GOALS

function get_all_goals($connect)
{

    $sentence = $connect->prepare("SELECT * FROM goals ORDER BY goal_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}

function id_goal($id_goal)
{
    return (int)cleardata($id_goal);
}

function get_goal_per_id($connect, $id_goal)
{
    $sentence = $connect->query("SELECT * FROM goals WHERE goal_id = $id_goal LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}

function number_goals($connect)
{

    $total_numbers = $connect->prepare('SELECT * FROM goals');
    $total_numbers->execute(array());
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

/////////////////////////////////////////////////////////////////////////////////// BODYPARTS

function get_all_bodyparts($connect)
{

    $sentence = $connect->prepare("SELECT * FROM bodyparts ORDER BY bodypart_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}

function id_bodypart($id_bodypart)
{
    return (int)cleardata($id_bodypart);
}

function get_bodypart_per_id($connect, $id_bodypart)
{
    $sentence = $connect->query("SELECT * FROM bodyparts WHERE bodypart_id = $id_bodypart LIMIT 1");
    $sentence = $sentence->fetchAll();
    return ($sentence) ? $sentence : false;
}

function number_bodyparts($connect)
{

    $total_numbers = $connect->prepare('SELECT * FROM bodyparts');
    $total_numbers->execute(array());
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}


function selected_bodyparts($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT bodyparts.bodypart_title, bodyparts.bodypart_id, bodyparts.bodypart_image FROM bodyparts JOIN exercises_bodyparts ON exercises_bodyparts.bodypart_id = bodyparts.bodypart_id JOIN exercises ON exercises_bodyparts.exercise_id = ? GROUP BY exercises_bodyparts.bodypart_id');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}

function not_selected_bodyparts($connect)
{

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = intval($_GET['id']);

        $sentence = $connect->prepare('SELECT bodyparts.bodypart_title, bodyparts.bodypart_id, bodyparts.bodypart_image FROM bodyparts WHERE bodyparts.bodypart_id NOT IN (SELECT exercises_bodyparts.bodypart_id FROM exercises_bodyparts WHERE exercises_bodyparts.exercise_id = ? GROUP BY exercises_bodyparts.bodypart_id)');
        $sentence->execute([$id]);
        return $sentence->fetchAll();
    }
}


/////////////////////////////////////////////////////////////////////////////////// CUSTOMS


function get_all_settings($connect)
{

    $sentence = $connect->query("SELECT * FROM settings");
    $sentence->execute();
    return $sentence->fetchAll();
}

function get_all_strings($connect)
{

    $sentence = $connect->query("SELECT * FROM strings");
    $sentence->execute();
    return $sentence->fetchAll();
}

function fecha($fecha)
{

    $timestamp = strtotime($fecha);
    $meses = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $dia = date('d', $timestamp);
    $mes = date('m', $timestamp) - 1;
    $ano = date('Y', $timestamp);

    $fecha = "$dia " . $meses[$mes] . " $ano";
    return $fecha;
}

function time_ago($date)
{
    if (empty($date)) {
        return "-";
    }
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
    $now = time();
    $uni_date = strtotime($date);
    // check validity of date
    if (empty($uni_date)) {
        return "-";
    }
    // is it future date or past date
    if ($now > $uni_date) {
        $difference = $now - $uni_date;
        $tense = "ago";
    } else {
        $difference = $uni_date - $now;
        $tense = "from now";
    }
    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }
    $difference = round($difference);
    if ($difference != 1) {
        $periods[$j] .= "s";
    }
    return "$difference $periods[$j] {$tense}";
}
