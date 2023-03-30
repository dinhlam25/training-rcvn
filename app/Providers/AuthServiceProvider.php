<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        Passport::tokensCan([
            // 'place-orders' => 'Place orders',
            // 'check-status' => 'Check order status',
            'admin'    => 'All permission',
            'editor'   => 'edit product and read, not Crud users',
            'reviewer' => 'means only read not fix',
        ]);
    }
}
