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

    public function getTask(int $task_id): Task
    {
        return Task::find($task_id);
    }
    public function updateTask(Collection $data): bool
    {
        return Task::find($data->get('id'))
            ->update([
                'title'       => $data->get('title'),
                'description' => $data->get('description'),
                'status'      => $data->get('status'),
                'user_id'     => $data->get('user_id'),
            ]);
    }

    public function deleteTask(int $task_id): bool
    {
        return Task::find($task_id)->delete();
    }
}
