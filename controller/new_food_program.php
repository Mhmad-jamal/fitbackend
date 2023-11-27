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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    function storeProgramFood($connect, $jsonprogram, $fat, $protein, $carbs, $calories, $category_id, $name,$serializedAllergies)
{
    try {
        // Prepare the SQL statement
        $sql = "INSERT INTO program_food (program, fat, protein, carbs, calories, category_id, name,Allergies) 
                VALUES ( :jsonprogram,:fat, :protein, :carbs, :calories, :category_id, :name ,:allergies)";

        $stmt = $connect->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':jsonprogram', $jsonprogram); // Corrected parameter name

        $stmt->bindParam(':fat', $fat);
        $stmt->bindParam(':protein', $protein);
        $stmt->bindParam(':carbs', $carbs);
        $stmt->bindParam(':calories', $calories);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':allergies', $serializedAllergies);

        // Execute the statement
        $stmt->execute();
        header('Location:' . SITE_URL . '/controller/workouts.php');

        // Redirect after successful insertion
    } catch (PDOException $e) {
        // Handle the exception (e.g., log the error, show a user-friendly message)
        echo "Error: " . $e->getMessage();
        exit();
    }
}
    $program = array(
        'day1' => isset($_POST['day1']) ? json_encode($_POST['day1']) : null,
        'day2' => isset($_POST['day2']) ? json_encode($_POST['day2']) : null,
        'day3' => isset($_POST['day3']) ? json_encode($_POST['day3']) : null,
        'day4' => isset($_POST['day4']) ? json_encode($_POST['day4']): null,
        'day5' => isset($_POST['day5']) ?json_encode( $_POST['day5']) : null,
        'day6' => isset($_POST['day6']) ? json_encode($_POST['day6']) : null,
        'day7' => isset($_POST['day7']) ? json_encode($_POST['day7']) : null
    );
    $fat = $_POST["fat"] ?? 0;
$protein = $_POST["protein"] ?? 0;
$carbs = $_POST["carbs"] ?? 0;
$calories = $_POST["calories"] ?? 0;
$category_id=$_POST["category_id"];
$name=$_POST["name"];
$Allergies = json_encode($_POST["Allergies"] ?? [0]);

$Allergies = is_array($_POST["Allergies"]) ? json_encode($_POST["Allergies"]) : [0];$jsonprogram = json_encode($program);


storeProgramFood($connect, $jsonprogram, $fat, $protein, $carbs, $calories, $category_id, $name,$Allergies);


    // Now you can use the $program array as needed, for example, you might want to encode it as JSON before sending it to the backend
	header('Location: ' . SITE_URL . '/controller/food_program.php');		



}

$food_list1 = get_all_diets($connect);
$food_list2 = get_all_diets($connect);
$food_list3 = get_all_diets($connect);
$food_list4 = get_all_diets($connect);
$food_list5 = get_all_diets($connect);
$food_list6 = get_all_diets($connect);
$food_list7 = get_all_diets($connect);
$Allergies_list = get_allergies_and_diseases($connect);

$category_list = get_all_categories($connect);

require '../views/new_food_program.php';
require '../views/footer.view.php';
    
}else {
	header('Location: ' . SITE_URL . '/controller/login.php');		
}


?>