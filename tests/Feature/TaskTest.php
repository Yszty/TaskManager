<?php

use App\Models\Task;
use Illuminate\Testing\Fluent\AssertableJson;

it('create task successfully', function() {
    $task_title       = 'title';
    $task_description = 'description';
    $task_status      = 'to_do';

    $response = $this->postJson("api/task/create", [
        'title'       => $task_title,
        'description' => $task_description,
        'status'      => $task_status,
        'userId'      => 1,
    ]);

    $response->assertStatus(200);

    $response->assertJson(
        fn (AssertableJson $json) => $json->where('user_id', 1)
                                          ->where('id', 1)
                                          ->where('title', $task_title)
                                          ->where('description', $task_description)
                                          ->where('status', $task_status)
                                          ->hasAll(['updated_at', 'created_at'])
    );

    $this->assertDatabaseHas(
        'tasks', [
            'id'          => 1,
            'user_id'     => 1,
            'title'       => $task_title,
            'description' => $task_description,
            'status'      => $task_status,
        ]
    );
});

it('fail to create task with missing data', function() {
    $response = $this->postJson("api/task/create", []);

    $response->assertStatus(200);

    $response->assertJson(
        fn (AssertableJson $json) => $json->where('message', 'Validation errors')
                                          ->hasAll(['success', 'data'])
    );
});

it('delete task successfully', function() {
    $response = $this->postJson("api/task/create", [
        'title'       => 'title',
        'description' => 'description',
        'status'      => 'to_do',
        'userId'      => 1,
    ]);

    $response->assertStatus(200);

    $task_id = $response->json()['id'];

    $task = Task::find($task_id);
    $this->assertNotNull($task);

    $this->deleteJson("api/task/delete/$task_id")
         ->assertStatus(200);

    $task = Task::find($task_id);
    $this->assertNull($task);
});
