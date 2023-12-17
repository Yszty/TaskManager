<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct(
        private UserServiceInterface $userService,
    ) {
    }

    public function createUser(UserCreateRequest $request): JsonResponse
    {
        $data = collect($request->getPayload());

        $user = $this->userService->createUser(collect([
            'uuid'       => Str::random(),
            'firstName' => $data->get('firstName'),
            'lastName'  => $data->get('lastName'),
            'email'      => $data->get('email')
        ]));

        return response()->json($user);
    }

    public function importUser(string $id): JsonResponse
    {
        $response = Http::withHeaders([
            'app-id' => '657f5509cbe9ff32ec8df567',
        ])->get('https://dummyapi.io/data/v1/user/' . $id);

        if ($response->successful()) {
            $user_data = $response->object();

            if ($this->userService->getUserByEmail($user_data->email)) {
                return response()->json(['message' => 'User already exists'], 409);
            }

            $user = $this->userService->createUser(collect([
                'uuid'       => $user_data->id,
                'firstName'  => $user_data->firstName,
                'lastName'   => $user_data->lastName,
                'email'      => $user_data->email,
            ]));

            return response()->json($user, 200);
        }

        return response()->json(['message' => $response->object()?->error], 400);
    }
}
