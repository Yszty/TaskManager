<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Services\Interfaces\TaskServiceInterface;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function __construct(
        private TaskServiceInterface $taskService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function createTask(TaskRequest $request)
    {
        $tasks = $this->taskService->createTask(
            collect($request->getPayload())
        );

        return response()->json($tasks);
    }

}
