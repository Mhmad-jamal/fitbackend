<?php

$page = 1;
if (!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if ($page === false || $page < 1) {
        $page = 1;
    }
}

$limit = 10;
if (!empty($_GET['limit'])) {
    $limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);
    if ($limit === false || $limit < 1) {
        $limit = 10;
    }
}

$offset = ($page - 1) * $limit;

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

require './app_core.php';

$sqlQuery = "
    SELECT program_food.*, categories.category_image
    FROM program_food
    LEFT JOIN categories ON program_food.category_id = categories.category_id";

if (getParamsUser()) {
    $sqlQuery .= " WHERE program_food.id IN (SELECT diets_users.du_diet FROM diets_users WHERE diets_users.du_user = '" . getParamsUser() . "')";
}

$sqlQuery .= " ORDER BY program_food.id DESC";

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $sqlQuery .= " LIMIT " . $offset . "," . $limit;
}

if (isset($_GET['limit']) && !empty($_GET['limit']) && !isset($_GET['page'])) {
    $sqlQuery .= " LIMIT " . $limit;
}

$sentence = $connect->prepare($sqlQuery);
$sentence->execute();
$qResults = $sentence->fetchAll(PDO::FETCH_ASSOC);

foreach ($qResults as $key => $value) {
    var_dump($value["id"]);
    $program = get_food_program_by_id_mobile($connect, $value['id']);
    if ($program !== false) {
        $qResults[$key] = $program;
    }
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

echo json_encode($qResults, JSON_NUMERIC_CHECK);
?>
