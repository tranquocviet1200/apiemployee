<?php

namespace App\Providers;

use App\Modules\Employee\Repositories\EmployeeRepository;
use App\Modules\Employee\Repositories\Interfaces\EmployeeRepositoryinterface;
use App\Modules\Employee\Services\EmployeeService;
use App\Modules\Employee\Services\Interfaces\EmployeeServiceInterface;
use Illuminate\Support\ServiceProvider;

class EmployeeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            EmployeeRepositoryinterface::class,
            EmployeeRepository::class
        );

        $this->app->bind(
            EmployeeServiceInterface::class,
            EmployeeService::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
