<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantDatabaseCreated;
use App\Tenants\Models\Tenant;
use Illuminate\Support\Facades\Artisan;

class SetUpTenantDatabase
{
    /**
     * Handle the event.
     *
     * @param  TenantDatabaseCreated $event
     * @return void
     */
    public function handle(TenantDatabaseCreated $event)
    {
        $this->migrate($event->tenant) && $this->seed($event->tenant);
    }

    protected function migrate(Tenant $tenant)
    {
        $migration = Artisan::call('tenants:migrate', [
            '--tenants' => [$tenant->id]
        ]);

        return $migration === 0;
    }

    protected function seed(Tenant $tenant)
    {
        $migration = Artisan::call('tenants:seed', [
            '--tenants' => [$tenant->id]
        ]);
    }
}
