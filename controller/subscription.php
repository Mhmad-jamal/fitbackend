<?php

 session_start();

define('SITE_URL', 'https://appadmin.mohannad-theeb.com/');
if (isset($_SESSION['manager_email'])){
    
require '../admin/config.php';
require '../admin/functions.php';	
require '../views/header.view.php';
require '../views/navbar.view.php';    

require '../views/subscription.view.php';
require '../views/footer.view.php';
    
}else {
		header('Location: ' . SITE_URL . '/controller/login.php');		
		}


?>