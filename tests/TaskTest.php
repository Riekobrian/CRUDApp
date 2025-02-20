<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\TaskModel;
use App\Services\TaskService;

final class TaskTest extends TestCase
{
    private TaskModel $taskModel;
    private TaskService $taskService;

    protected function setUp(): void
    {
        $this->taskModel = new TaskModel();
        $this->taskService = new TaskService($this->taskModel);
    }

    public function testCreateTask(): void
    {
        $data = [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'status' => 'Pending',
            'priority' => 'Medium'
        ];

        $result = $this->taskService->createTask($data);

        $this->assertArrayHasKey('id', $result);
        $this->assertGreaterThan(0, $result['id']);
        $this->assertEquals('Task created successfully', $result['message']);
    }

    public function testUpdateTask(): void
    {
        $createData = [
            'title' => 'Original Task',
            'description' => 'Original Description',
            'status' => 'Pending',
            'priority' => 'Low'
        ];
        $createResult = $this->taskService->createTask($createData);
        $taskId = $createResult['id'];

        $updateData = [
            'title' => 'Updated Task',
            'description' => 'Updated Description',
            'status' => 'In Progress',
            'priority' => 'High'
        ];
        $updateResult = $this->taskService->updateTask($taskId, $updateData);

        $this->assertEquals('Task updated successfully', $updateResult['message']);

        // Verify the update
        $updatedTask = $this->taskService->getTaskById($taskId);
        $this->assertEquals('Updated Task', $updatedTask['title']);
        $this->assertEquals('In Progress', $updatedTask['status']);
    }

    public function testInvalidTaskCreation(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $invalidData = [
            'title' => '',
            'description' => 'Test',
            'status' => 'Invalid Status',
            'priority' => 'Invalid Priority'
        ];

        $this->taskService->createTask($invalidData);
    }
}
