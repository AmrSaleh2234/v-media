<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Hr\Branch;
use App\Policies\BranchPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
      Branch::class => BranchPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
       Gate::before(function ($user, $ability) {
           return $user->id === 1 || $user->id === 5  ? true : null;
       });
        Passport::tokensCan([
            'client' => 'Client App',
            'employee' => 'Employee App',
        ]);
        Passport::setDefaultScope([
            'client',
            'employee',
        ]);
    }
}
