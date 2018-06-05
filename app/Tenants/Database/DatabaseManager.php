<?php

namespace App\Tenants\Database;


use App\Tenants\Models\Tenant;

class DatabaseManager
{
    public function createConnection(Tenant $tenant)
    {
        config()->set('database.connections.tenant', $this->getTenantConnection($tenant));
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