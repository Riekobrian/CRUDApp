<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class TaskModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAllTasks()
    {
        $stmt = $this->pdo->query("SELECT * FROM tasks ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Renamed method to match test case
    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createTask($title, $description, $status, $priority)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO tasks (title, description, status, priority) 
            VALUES (:title, :description, :status, :priority)
        ");
        $stmt->execute([
            'title'       => $title,
            'description' => $description,
            'status'      => $status,
            'priority'    => $priority
        ]);
        return $this->pdo->lastInsertId(); // Return inserted task ID
    }

    public function updateTask($id, $title, $description, $status, $priority)
    {
        $stmt = $this->pdo->prepare("
            UPDATE tasks 
            SET title = :title, description = :description, status = :status, priority = :priority 
            WHERE id = :id
        ");
        return $stmt->execute([
            'id'          => $id,
            'title'       => $title,
            'description' => $description,
            'status'      => $status,
            'priority'    => $priority
        ]);
    }

    public function deleteTask($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
