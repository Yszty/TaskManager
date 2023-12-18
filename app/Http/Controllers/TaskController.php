<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskUpdateRequest;
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

    public function getTask(int $id)
    {
        $task = $this->taskService->getTask($id);

        if($task){
            return response()->json($task);
        }

        return response()->json([
            'message' => 'Task not found.'
        ], 404);
    }

    public function changeStatus($taskId)
    {
        $task = $this->taskService->changeStatus($taskId);

        if($task){
            return response()->json($task);
        }

        return response()->json(['message' => 'Nothing to change'], 409);
    }

    public function updateTask(TaskUpdateRequest $request)
    {
        $task = $this->taskService->getTask($request->get('id'));

        if($task){
            return $this->taskService->updateTask(
                collect($request->getPayload())
            );
        }

        return response()->json([
            'message' => 'Task not found.'
        ], 404);

    }

}
