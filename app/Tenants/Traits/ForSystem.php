<?php

namespace App\Tenants\Traits;


trait ForSystem
{
    public function getConnectionName()
    {
        return 'mysql';
    }
}