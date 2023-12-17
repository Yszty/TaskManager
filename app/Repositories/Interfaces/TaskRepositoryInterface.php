<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\Task;
use Illuminate\Support\Collection;

interface TaskRepositoryInterface
{

    public function createTask(Collection $data): Task;

}
