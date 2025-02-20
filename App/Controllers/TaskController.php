<?php

namespace App\Controllers;

use App\Services\TaskService;
use App\Models\TaskModel;

class TaskController
{
    private TaskService $taskService;

    public function __construct()
    {
        $taskModel = new TaskModel(); // Create TaskModel instance
        $this->taskService = new TaskService($taskModel); // Pass TaskModel to TaskService
    }

    /**
     * Handle incoming HTTP requests
     */
    public function handleRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $data = json_decode(file_get_contents("php://input"), true) ?? [];
        header("Content-Type: application/json");

        try {
            switch ($method) {
                case 'GET':
                    echo json_encode(["tasks" => $this->taskService->getAllTasks()]);
                    break;

                case 'POST':
                    echo json_encode($this->taskService->createTask($data));
                    break;

                case 'PUT':
                    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
                        throw new \InvalidArgumentException("Task ID is required and must be a number");
                    }
                    echo json_encode($this->taskService->updateTask((int)$_GET['id'], $data));
                    break;

                case 'DELETE':
                    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
                        throw new \InvalidArgumentException("Task ID is required and must be a number");
                    }
                    echo json_encode(["success" => $this->taskService->deleteTask((int)$_GET['id'])]);
                    break;

                default:
                    http_response_code(405);
                    echo json_encode(["error" => "Method not allowed"]);
                    break;
            }
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}
