<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Models\Task;
use Illuminate\Support\Collection;

interface TaskServiceInterface
{
    public function createTask(Collection $data): Task;
}
