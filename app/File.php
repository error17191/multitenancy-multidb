<?php

namespace App;

use App\Tenants\Traits\ForTenant;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use ForTenant;
    protected $fillable = ['name', 'path'];
}
