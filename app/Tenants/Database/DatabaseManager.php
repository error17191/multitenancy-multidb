<?php

namespace App\Tenants\Database;


use App\Tenants\Models\Tenant;
use Illuminate\Database\DatabaseManager as BaseDatabaseManager;

class DatabaseManager
{
    protected $db;

    public function __construct(BaseDatabaseManager $db)
    {
        $this->db = $db;
    }

    public function createConnection(Tenant $tenant)
    {
        config()->set('database.connections.tenant', $this->getTenantConnection($tenant));
    }

    public function connectToTenant()
    {
        $this->db->reconnect();
    }

    public function purge()
    {
        $this->db->purge('tenant');
    }

    protected function getTenantConnection($tenant)
    {
        return array_merge(config()->get($this->getDefaultConnectionPath())
            , $tenant->tenantConnection->only('database')
        );
    }

    protected function getDefaultConnectionPath()
    {
        return 'database.connections.' . config()->get('database.default');
    }
}