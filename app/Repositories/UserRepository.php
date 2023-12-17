<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(Collection $data): User
    {
        return User::create([
            'uuid'       => $data->get('uuid'),
            'first_name' => $data->get('firstName'),
            'last_name'  => $data->get('lastName'),
            'email'      => $data->get('email'),
        ]);
    }

    public function getUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function getUserByUuid(string $uuid): ?User
    {
        return User::where('uuid', $uuid)->first();
    }
}
