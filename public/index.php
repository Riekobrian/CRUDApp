<?php

declare(strict_types=1);

// Database configuration
$host = 'localhost';
$user = 'root';
$pass = 'Bigbucks2024';
$db = 'modern_crud';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed"]));
}

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\TaskController;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

$controller = new TaskController();
$controller->handleRequest();

$conn->close();

// declare(strict_types=1);


// declare(strict_types=1);

// // Database configuration
// $host = 'localhost';
// $user = 'root';
// $pass = 'Bigbucks2024';
// $db = 'modern_crud';

// // Create connection
// $conn = new mysqli($host, $user, $pass, $db);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// // If you have additional code, place it here
// require_once __DIR__ . '/../vendor/autoload.php';

// use App\Controllers\TaskController;

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
// header("Access-Control-Allow-Headers: Content-Type");

// $controller = new TaskController();
// $controller->handleRequest();
// // Close connection when done
// $conn->close();
// declare(strict_types=1);

// require_once __DIR__ . '/../vendor/autoload.php';

// use App\Controllers\TaskController;

// $controller = new TaskController();
// $controller->handleRequest();
