<?php

namespace App\Tenants\Traits;


trait ForTenant
{
    public function getConnectionName()
    {
        return 'tenant';
    }
}