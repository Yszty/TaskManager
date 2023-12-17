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
            'userId'     => $data->get('user_id'),
        ]);
    }
}
