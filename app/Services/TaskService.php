<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Services\Interfaces\TaskServiceInterface;
use Illuminate\Support\Collection;

class TaskService implements TaskServiceInterface
{
    public function __construct(
        private TaskRepositoryInterface $taskRepository,
    ) {
    }
    public function createTask(Collection $data): Task
    {
        return $this->taskRepository->createTask($data);
    }

    public function getTask(int $taskId): ?Task
    {
        return $this->taskRepository->getTask($taskId);
    }

    public function updateTask(int $taskId, Collection $data): Task
    {
        return $this->taskRepository->updateTask($taskId, $data);
    }

    public function deleteTask(int $taskId): bool
    {
        return $this->taskRepository->deleteTask($taskId);
    }

    public function changeStatus(int $taskId): ?Task
    {
        $task = $this->taskRepository->getTask($taskId);

        return match($task->getAttribute('status')){
            'to_do' => $this->taskRepository->updateTaskStatus($task->getAttribute('id'), 'in_progress'),
            'in_progress' => $this->taskRepository->updateTaskStatus($task->getAttribute('id'), 'done'),
            default => null
        };

    }

}
