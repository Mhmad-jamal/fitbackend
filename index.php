<?php 



session_start();

define('SITE_URL', 'https://appadmin.mohannad-theeb.com/');

if (isset($_SESSION['manager_email'])){
    
    header('Location: ./controller/home.php');
} else {
    
    header('Location: ./controller/login.php');
}



?>