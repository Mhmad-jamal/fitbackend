<?php 
ob_start(); 

session_start();

define('SITE_URL', 'https://appadmin.mohannad-theeb.com/');
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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        function updateProgramFood($connect, $jsonprogram, $fat, $protein, $carbs, $calories, $category_id, $name, $serializedAllergies, $program_id)
        {
            try {
                // Prepare the SQL statement for updating existing entry
                $sql = "UPDATE program_food 
                        SET program = :jsonprogram, 
                            fat = :fat, 
                            protein = :protein, 
                            carbs = :carbs, 
                            calories = :calories, 
                            category_id = :category_id, 
                            name = :name,
                            Allergies = :allergies
                        WHERE id = :program_id";
    
                $stmt = $connect->prepare($sql);
    
                // Bind parameters
                $stmt->bindParam(':jsonprogram', $jsonprogram);
                $stmt->bindParam(':fat', $fat);
                $stmt->bindParam(':protein', $protein);
                $stmt->bindParam(':carbs', $carbs);
                $stmt->bindParam(':calories', $calories);
                $stmt->bindParam(':category_id', $category_id);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':allergies', $serializedAllergies);
                $stmt->bindParam(':program_id', $program_id);
    
                // Execute the statement
                $stmt->execute();
                header('Location:' . SITE_URL . '/controller/workouts.php');
    
                // Redirect after successful update
            } catch (PDOException $e) {
                // Handle the exception (e.g., log the error, show a user-friendly message)
                echo "Error: " . $e->getMessage();
                exit();
            }
        }
    
        // Assuming you have a parameter in the URL or form that identifies the program you want to edit (replace 'program_id' with the actual parameter name)
        $program_id = $_POST['program_id'] ?? null;
    
        if ($program_id !== null) {
            // If program_id is present, it means we are editing an existing entry
            $program = array(
                'day1' => isset($_POST['day1']) ? json_encode($_POST['day1']) : null,
                'day2' => isset($_POST['day2']) ? json_encode($_POST['day2']) : null,
                'day3' => isset($_POST['day3']) ? json_encode($_POST['day3']) : null,
                'day4' => isset($_POST['day4']) ? json_encode($_POST['day4']) : null,
                'day5' => isset($_POST['day5']) ? json_encode($_POST['day5']) : null,
                'day6' => isset($_POST['day6']) ? json_encode($_POST['day6']) : null,
                'day7' => isset($_POST['day7']) ? json_encode($_POST['day7']) : null
            );
    
            $fat = $_POST["fat"] ?? 0;
            $protein = $_POST["protein"] ?? 0;
            $carbs = $_POST["carbs"] ?? 0;
            $calories = $_POST["calories"] ?? 0;
            $category_id = $_POST["category_id"];
            $name = $_POST["name"];

            $Allergies = json_encode(
                isset($_POST["Allergies"]) && is_array($_POST["Allergies"]) && count($_POST["Allergies"]) > 0
                ? $_POST["Allergies"]
                : ["0"]
            );         
               $jsonprogram = json_encode($program);
    
            updateProgramFood($connect, $jsonprogram, $fat, $protein, $carbs, $calories, $category_id, $name, $Allergies, $program_id);
    
            // Now you can use the $program array as needed, for example, you might want to encode it as JSON before sending it to the backend
            header('Location: ' . SITE_URL . '/controller/food_program.php');
        } else {
            // Handle the case where program_id is not present (e.g., display an error message)
            echo "Program ID is missing.";
        }
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

require '../views/edit_food_program.php';
require '../views/footer.view.php';
    
}else {
	header('Location: ' . SITE_URL . '/controller/login.php');		
}


?>