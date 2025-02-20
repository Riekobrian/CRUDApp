<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../../app/Config/Database.php';
require_once __DIR__ . '/../../app/Models/TaskModel.php';

use App\Models\TaskModel;

$taskModel = new TaskModel();
$taskModel->deleteTask($_GET['id']);

header('Location: index.php');
exit;
