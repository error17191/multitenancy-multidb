<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tenants\Traits\ForTenant;

class Project extends Model
{
    use ForTenant;

    protected $fillable = ['name'];

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
