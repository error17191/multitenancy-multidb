<?php

namespace App\Tenants\Traits;

use App\TenantConnection;
use App\Tenants\Models\Tenant;

trait IsTenant
{
    public static function boot()
    {
        parent::boot();

        static::created(function ($tenant) {
            $tenant->tenantConnection()->save(static::newDatabaseConnection($tenant));
        });
    }

    protected static function newDatabaseConnection(Tenant $tenant)
    {
        return new TenantConnection([
            'database' => "fresh_{$tenant->id}"
        ]);
    }

    public function tenantConnection()
    {
        return $this->hasOne(TenantConnection::class, 'company_id', 'id');
    }
}