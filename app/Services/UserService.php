<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class UserService implements UserServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {
    }

    public function createUser(Collection $data): User
    {
        return $this->userRepository->createUser($data);
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->userRepository->getUserByEmail($email);
    }

    public function getUserByUuid(string $uuid): ?User
    {
        return $this->userRepository->getUserByUuid($uuid);
    }

    public function importUser(string $id): ?User {

        $response = Http::withHeaders([
            'app-id' => '657f5509cbe9ff32ec8df567',
        ])->get('https://dummyapi.io/data/v1/user/' . $id);

        if ($response->successful()) {
            $user_data = $response->object();

            if ($this->userRepository->getUserByEmail($user_data->email)) {
                return null;
            }

            $user = $this->userRepository->createUser(collect([
                'uuid'       => $user_data->id,
                'firstName'  => $user_data->firstName,
                'lastName'   => $user_data->lastName,
                'email'      => $user_data->email,
            ]));

            return $user;
        }

        return null;
    }

}
