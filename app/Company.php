<?php

namespace App;

use App\Tenants\Models\Tenant;
use App\Tenants\Traits\ForSystem;
use App\Tenants\Traits\IsTenant;
use Illuminate\Database\Eloquent\Model;

class Company extends Model implements Tenant
{
    use IsTenant,ForSystem;

    protected $fillable = ['name'];
}
