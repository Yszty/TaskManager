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
}
