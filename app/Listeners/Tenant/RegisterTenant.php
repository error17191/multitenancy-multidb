<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantIdentified;
use App\Tenants\Database\DatabaseManager;
use App\Tenants\Manager;

class RegisterTenant
{
    protected $db;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->db = $databaseManager;
    }

    /**
     * Handle the event.
     *
     * @param  TenantIdentified $event
     * @return void
     */
    public function handle(TenantIdentified $event)
    {
        app(Manager::class)->setTenant($event->tenant);

        $this->db->createConnection($event->tenant);
    }
}
