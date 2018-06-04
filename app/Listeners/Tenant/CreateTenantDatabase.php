<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantWasCreated;
use App\Tenants\Database\DatabaseCreator;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateTenantDatabase
{
    private $databaseCreator;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DatabaseCreator $databaseCreator)
    {
        $this->databaseCreator = $databaseCreator;
    }

    /**
     * Handle the event.
     *
     * @param  TenantWasCreated $event
     * @return void
     */
    public function handle(TenantWasCreated $event)
    {
        if (!$this->databaseCreator->create($event->tenant)) {
            throw new \Exception('Database Failed to Be Created');
        }
    }
}
