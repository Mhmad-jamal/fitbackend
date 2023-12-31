<?php

$page = 1;
if(!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if(false === $page) {
        $page = 1;
    }
}

$limit = 10;
if(!empty($_GET['limit'])) {
    $limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);
}

$offset = ($page - 1) * $limit;

header('Content-Type: application/json');
header("access-control-allow-origin: *");

require './app_core.php';

$sqlQuery = "SELECT * FROM diets WHERE diet_status = 1";

	if(getParamsID()){

		$sqlQuery .= " AND diets.diet_id = '".getParamsID()."'";
	}

	if(getParamsCategory()){

        $sqlQuery .= " AND diets.diet_category = '".getParamsCategory()."'";
	}

	if(getParamsPrice()){

        $sqlQuery .= " AND diets.diet_price = '".getParamsPrice()."'";
	}

	if(getParamsQuery()){

        $sqlQuery .= " AND diets.diet_title LIKE '%".getParamsQuery()."%'";
	}

	if(getParamsUser()){

        $sqlQuery .= " AND diets.diet_id IN (SELECT diets_users.du_diet FROM diets_users WHERE diets_users.du_user = '".getParamsUser()."')";
	}

    $sqlQuery .= " ORDER BY diets.diet_id DESC";

    if(isset($_GET['page']) && !empty($_GET['page'])) {
        $sqlQuery .= " LIMIT ".$offset.",".$limit;
    }

    if(isset($_GET['limit']) && !empty($_GET['limit']) && !isset($_GET['page'])) {
        $sqlQuery .= " LIMIT ".$limit;
    }
    
    $sentence = $connect->prepare($sqlQuery);

    $sentence->execute();

    $qResults = $sentence->fetchAll(PDO::FETCH_ASSOC);

	$data = array();

	foreach ($qResults as $row) {

		$id = isset($row['diet_id']) ? $row['diet_id'] : null;
		$title = isset($row['diet_title']) ? $row['diet_title'] : null;
		$description = isset($row['diet_description']) ? $row['diet_description'] : null;
		$ingredients = isset($row['diet_ingredients']) ? $row['diet_ingredients'] : null;
		$instructions = isset($row['diet_directions']) ? $row['diet_directions'] : null;
		$image = isset($row['diet_image']) ? $row['diet_image'] : null;
		$category = isset($row['category_title']) ? $row['category_title'] : "";
		$calories = isset($row['diet_calories']) ? $row['diet_calories'] : null;
		$carbs = isset($row['diet_carbs']) ? $row['diet_carbs'] : null;
		$protein = isset($row['diet_protein']) ? $row['diet_protein'] : null;
		$fat = isset($row['diet_fat']) ? $row['diet_fat'] : null;
		$time = isset($row['diet_time']) ? $row['diet_time'] : null;
		$servings = isset($row['diet_servings']) ? $row['diet_servings'] : null;
		$price = isset($row['diet_price']) ? $row['diet_price'] : null;
$link = isset($row['link']) ? $row['link'] : null;
		

		$data[] = array(
			'id'=> $id,
			'title'=> html_entity_decode($title),
			'description'=> html_entity_decode($description),
			'ingredients'=> html_entity_decode($ingredients),
			'instructions'=> html_entity_decode($instructions),
			'image'=> getImage($image),
			'category'=> html_entity_decode($category),
			'calories'=> html_entity_decode($calories),
			'carbs'=> html_entity_decode($carbs),
			'protein'=> html_entity_decode($protein),
			'fat'=> html_entity_decode($fat),
			'time'=> html_entity_decode($time),
			'servings'=> html_entity_decode($servings),
			'price'=> $price,
			'link'=>$link
		);
	}

	print json_encode($data, JSON_NUMERIC_CHECK);

?>