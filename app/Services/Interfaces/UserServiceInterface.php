<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserServiceInterface
{
    public function createUser(Collection $data): User;

    public function getUserByEmail(string $email): ?User;

    public function getUserByUuid(string $uuid): ?User;
}
