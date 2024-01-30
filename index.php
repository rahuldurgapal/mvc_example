<?php

error_reporting(E_WARNING|E_NOTICE);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


$action = $_GET['action'] ?? 'login';

// Database connection setup (replace these credentials with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include("controllers/AuthController.php");
include("controllers/StudentController.php");

$authController = new AuthController($conn);
$studentController = new StudentController($conn);


switch ($action) {
    case 'register':
        $authController->register();
        break;
    case 'login':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'panel':
        $studentController->panel();
        break;
    default:
        echo '404 Not Found';
        break;
}

$conn->close();

?>