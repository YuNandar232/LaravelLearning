<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\MajorRepository;
use App\Repositories\MajorRepositoryInterface;
use App\Repositories\StudentRepository;
use App\Repositories\StudentRepositoryInterface;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MajorRepositoryInterface::class, MajorRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
