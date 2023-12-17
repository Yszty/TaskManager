<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function createUser(Collection $data): User;

    public function getUserByEmail(string $email): ?User;
}
