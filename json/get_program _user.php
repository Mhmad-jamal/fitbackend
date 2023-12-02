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

$sqlQuery = "SELECT * FROM program_food";

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

echo json_encode($qResults, JSON_NUMERIC_CHECK);
?>
