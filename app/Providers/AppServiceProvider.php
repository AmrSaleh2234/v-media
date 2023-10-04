<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Html\Builder;
class AppServiceProvider extends ServiceProvider
{
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
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
//        Builder::useVite();

        Relation::morphMap([
            'employees' => 'App\Models\Employee\Employee',
            'clients' => 'App\Models\Client',
            'brokers' => 'App\Models\Broker',
            'messages' => 'App\Models\Message',
            'branches' => 'App\Models\Hr\Branch',
            'managements' => 'App\Models\Hr\Management',
            'departments' => 'App\Models\Hr\Department',
            'company-projects' => 'App\Models\CMS\CompanyProject',
            'services' => 'App\Models\CMS\Service',
            'banners' => 'App\Models\CMS\Banner',
            'members' => 'App\Models\CMS\Member',
            'icons' => 'App\Models\CMS\Icon',
            'pages' => 'App\Models\CMS\Page',
            'sections' => 'App\Models\CMS\Section',

        ]);

    }
}
