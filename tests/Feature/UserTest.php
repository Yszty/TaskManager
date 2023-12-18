<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Fluent\AssertableJson;

it('import user successfully', function() {
    $user_firstname = 'John';
    $user_lastname  = 'Doe';
    $user_email     = 'john@example.com';
    $user_uuid      = '60d0fe4f5311236168a109ca';

    Http::fake([
        'https://dummyapi.io/data/v1/user/*' => Http::response([
            'id'        => $user_uuid,
            'firstName' => $user_firstname,
            'lastName'  => $user_lastname,
            'email'     => $user_email,
        ], 200),
    ]);

    $response = $this->getJson('api/user/import/60d0fe4f5311236168a109ca');

    $response->assertStatus(200);

    $response->assertJson(
        fn (AssertableJson $json) => $json->where('id', 1)
                                          ->where('uuid', $user_uuid)
                                          ->where('first_name', $user_firstname)
                                          ->where('last_name', $user_lastname)
                                          ->where('email', $user_email)
                                          ->hasAll(['updated_at', 'created_at'])
    );

    $this->assertDatabaseHas(
        'users', [
        'id'         => 1,
        'uuid'       => $user_uuid,
        'first_name' => $user_firstname,
        'last_name'  => $user_lastname,
        'email'      => $user_email,
    ]);
});
