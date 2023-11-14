<?php
session_start();
ob_start(); 

if (isset($_SESSION['manager_email'])) {
    require '../admin/config.php';
    require '../admin/functions.php';
    require '../views/header.view.php';
    require '../views/navbar.view.php';
    $connect = connect($database);
    $_SESSION['insert_message']="";

   
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['id']) && isset($_POST['submit_button'])) {
        $code = cleardata($_POST['code']);
        $subscription_id = cleardata($_POST["subscription_id"]);

        // Check if the code already exists in the database
        $existingRecord = check_existing_code($connect, $code);

        if ($existingRecord) {
            // If the code already exists, show a message
            $_SESSION['insert_message'] = '<div class="alert alert-danger text-center" role="alert">Code already exists!</div>';
        } else {
            try {
                $statement = $connect->prepare(
                    'INSERT INTO generated_code (code,subscription_id) VALUES (:code,:subscription_id)'
                );

                $success = $statement->execute(array(
                    ':code' => $code,
                    ':subscription_id' => $subscription_id,
                ));

                if ($success) {
                    $_SESSION['insert_message'] = '<div class="alert alert-success text-center" role="alert">Code inserted successfully!</div>';
                } else {
                    $_SESSION['insert_message'] = '<div class="alert alert-danger text-center" role="alert">Error inserting Code.</div>';
                }
            } catch (\PDOException $e) {
                $_SESSION['insert_message'] = '<div class="alert alert-danger text-center" role="alert">Error inserting record.</div>';
            }
        }
        header('Location: ' . SITE_URL . '/controller/generate_code.view.php');

    }

    $subscription_lists = get_all_subscritption($connect);

    require '../views/generate_code.view.php';
    require '../views/footer.view.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
        $id = $_POST['id'];

        try {
            $statement = $connect->prepare('DELETE FROM generated_code WHERE id = :id');
            $statement->execute(array('id' => $id));

            if ($statement->rowCount() > 0) {
                echo json_encode(['success' => true]);
                $_SESSION['insert_message'] = '<div class="alert alert-success text-center" role="alert">Delete code successfully!</div>';

            } else {
                echo json_encode(['success' => false]);
            }
        } catch (\PDOException $e) {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false]);
    }

} else {
    header('Location: ' . SITE_URL . '/controller/login.php');
}

// Function to check if the code already exists in the database
function check_existing_code($connect, $code)
{
    $statement = $connect->prepare('SELECT * FROM generated_code WHERE code = :code');
    $statement->execute(array(':code' => $code));
    $record = $statement->fetch(PDO::FETCH_ASSOC);

    return ($record !== false); // Return true if the record exists, false otherwise
}
?>
