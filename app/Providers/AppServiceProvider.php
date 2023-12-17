<?php

namespace App\Providers;

use App\Services\Interfaces\TaskServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\TaskService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All the container singletons that should be registered.
     *
     * @var array
     */
    public array $singletons = [
        TaskServiceInterface::class => TaskService::class,
        UserServiceInterface::class => UserService::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
