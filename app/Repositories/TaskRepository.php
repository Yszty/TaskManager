<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Support\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    public function createTask(Collection $data): Task
    {
        return Task::create([
            'title'       => $data->get('title'),
            'description' => $data->get('description'),
            'status'      => $data->get('status'),
            'user_id'     => $data->get('userId'),
        ]);
    }

    public function getTask(int $taskId): ?Task
    {
        return Task::find($taskId);
    }
    public function updateTask(int $taskId, Collection $data): Task
    {
        return tap(Task::find($taskId))
            ->update([
                'title'       => $data->get('title'),
                'description' => $data->get('description'),
            ]);
    }

    public function updateTaskStatus(int $taskId, string $status): Task
    {
        return tap(Task::find($taskId))
            ->update([
                'status'  => $status,
            ]);
    }
    public function deleteTask(int $taskId): bool
    {
        return Task::find($taskId)->delete();
    }
}
