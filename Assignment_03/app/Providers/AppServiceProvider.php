<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MajorService;
use App\Services\MajorServiceInterface;
use App\Services\StudentService;
use App\Services\StudentServiceInterface;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(MajorServiceInterface::class, MajorService::class);
        $this->app->singleton(StudentServiceInterface::class, StudentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
