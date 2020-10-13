<?php

namespace App\Providers;

use App\Models\Employee;
use App\Policies\EmployeePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
      // Employee::class => EmployeePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            
            return auth()->guard('employee')->user()->hasRole('super_admin') ? true : null;
        });
    }

}
