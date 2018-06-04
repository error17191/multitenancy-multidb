<?php

namespace App\Tenants\Database;


use App\Tenants\Models\Tenant;
use Illuminate\Support\Facades\DB;

class DatabaseCreator
{
    public function create(Tenant $tenant)
    {
        return DB::statement("
            CREATE DATABASE fresh_{$tenant->id}
        ");
    }
}