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

    public function getTask(int $task_id): ?Task
    {
        return $this->taskRepository->getTask($task_id);
    }

    public function updateTask(Collection $data): bool
    {
        return $this->taskRepository->updateTask($data);
    }

    public function deleteTask(int $task_id): bool
    {
        return $this->taskRepository->deleteTask($task_id);
    }
}
