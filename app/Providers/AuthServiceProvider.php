<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        //

        // Define Passport Scope

        Passport::tokensCan([

            'admin'=>'Add/Edit/Delete',
            'moderator'=>'Add/Edit',
            'basic'=>'List'
        ]);

        // Define Passport Default Scope

        Passport::setDefaultScope([
            'basic'
        ]);
    }
}
