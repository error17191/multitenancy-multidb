<?php

namespace App\Providers;

use App\Console\Commands\Tenant\Migrate;
use App\Console\Commands\Tenant\Rollback;
use App\Tenants\Database\DatabaseManager;
use App\Tenants\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Manager::class, function () {
            return new Manager();
        });

        Request::macro('tenant', function () {
            return app(Manager::class)->getTenant();
        });

        Blade::if ('tenant', function () {
            return app(Manager::class)->hasTenant();
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Migrate::class, function () {
            return new Migrate(app('migrator'),app(DatabaseManager::class));
        });

        $this->app->singleton(Rollback::class, function () {
            return new Rollback(app('migrator'),app(DatabaseManager::class));
        });
    }
}
