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
        $user = $this->userService->importUser($id);

        if($user) {
            return response()->json($user);
        }

        return response()->json(['message' => 'Import Error'], 400);
    }
}
