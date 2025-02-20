<?php

require_once '../app/Controllers/HomeController.php';

use App\Controllers\HomeController;

$uri = trim($_SERVER['REQUEST_URI'], '/');

if ($uri == 'public' || $uri == '') {
    $controller = new HomeController();
    echo $controller->index();
} else {
    echo "404 - Page Not Found";
}
