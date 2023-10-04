<?php

namespace Modules\Projects\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Projects\Entities\Project;
use Modules\Projects\Policies\ProjectPolicy;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Project::class=>ProjectPolicy::class,
    ];


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
