<?php 
ob_start(); 

session_start();
if (isset($_SESSION['manager_email'])){
    
    
require '../admin/config.php';
require '../admin/functions.php';
require '../views/header.view.php';
require '../views/navbar.view.php'; 

$errors = '';

$connect = connect($database);
if(!$connect){
	header('Location: ' . SITE_URL . '/controller/error.php');
	} 
   

    
if(isset($_GET["id"])){
    $id=$_GET['id'];
}else{
    header('Location: ' . SITE_URL . '/controller/food_program.php');

}
$food_program=get_food_program_by_id($connect,$id);
$program_data=$food_program[0];

$program = json_decode($program_data["program"]);

$day1_values = isset($program->day1) ? json_decode($program->day1, true) : [];
$day2_values = isset($program->day2) ? json_decode($program->day2, true) : [];
$day3_values = isset($program->day3) ? json_decode($program->day3, true) : [];
$day4_values = isset($program->day4) ? json_decode($program->day4, true) : [];
$day5_values = isset($program->day5) ? json_decode($program->day5, true) : [];
$day6_values = isset($program->day6) ? json_decode($program->day6, true) : [];
$day7_values = isset($program->day7) ? json_decode($program->day7, true) : [];



$program_allergies = json_decode($program_data["Allergies"], true) ?? [];



$food_list1 = get_all_diets($connect);
$food_list2 = get_all_diets($connect);
$food_list3 = get_all_diets($connect);
$food_list4 = get_all_diets($connect);
$food_list5 = get_all_diets($connect);
$food_list6 = get_all_diets($connect);
$food_list7 = get_all_diets($connect);
$Allergies_list = get_allergies_and_diseases($connect);

$category_list = get_all_categories($connect);

require '../views/pdf_food_program.php';
require '../views/footer.view.php';
    
}else {
	header('Location: ' . SITE_URL . '/controller/login.php');		
}


?>