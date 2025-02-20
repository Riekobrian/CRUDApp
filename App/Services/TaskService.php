<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\TaskModel;
use JsonException;

final class TaskService
{
    private TaskModel $taskModel;

    // Inject TaskModel in constructor
    public function __construct(TaskModel $taskModel)
    {
        $this->taskModel = $taskModel;
    }

    public function getAllTasks(): array
    {
        return $this->taskModel->getAllTasks();
    }

    public function getTaskById(int $id): ?array
    {
        return $this->taskModel->getById($id);
    }

    public function createTask(array $data): array
    {
        $this->validateTask($data);

        $taskId = $this->taskModel->createTask(
            $data['title'],
            $data['description'],
            $data['status'],
            $data['priority']
        );

        return ['id' => $taskId, 'message' => 'Task created successfully'];
    }

    public function updateTask(int $id, array $data): array
    {
        $this->validateTask($data);

        if ($this->taskModel->updateTask(
            $id,
            $data['title'],
            $data['description'],
            $data['status'],
            $data['priority']
        )) {
            return ['message' => 'Task updated successfully'];
        }

        throw new \RuntimeException('Failed to update task');
    }

    public function deleteTask(int $id): array
    {
        if ($this->taskModel->deleteTask($id)) {
            return ['message' => 'Task deleted successfully'];
        }
        throw new \RuntimeException('Failed to delete task');
    }

    private function validateTask(array $data): void
    {
        $requiredFields = ['title', 'description', 'status', 'priority'];

        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                throw new \InvalidArgumentException("$field is required");
            }
        }

        if (!in_array($data['status'], ['Pending', 'In Progress', 'Completed'], true)) {
            throw new \InvalidArgumentException('Invalid status');
        }

        if (!in_array($data['priority'], ['Low', 'Medium', 'High'], true)) {
            throw new \InvalidArgumentException('Invalid priority');
        }
    }
}
