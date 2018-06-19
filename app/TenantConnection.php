<?php

namespace App;

use App\Tenants\Traits\ForSystem;
use Illuminate\Database\Eloquent\Model;

class TenantConnection extends Model
{
    use ForSystem;

    protected $fillable = ['database'];
}
