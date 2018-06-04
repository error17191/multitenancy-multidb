<?php

namespace App\Tenants;

use App\Tenants\Models\Tenant;

class Manager
{
    protected $tenant;

    public function setTenant(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function getTenant()
    {
        return $this->tenant;
    }

    public function hasTenant()
    {
        return !is_null($this->tenant);
    }
}