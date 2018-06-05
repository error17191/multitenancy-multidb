<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tenants\Traits\ForTenant;

class Project extends Model
{
    use ForTenant;
}
