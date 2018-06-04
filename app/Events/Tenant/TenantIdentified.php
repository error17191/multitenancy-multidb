<?php

namespace App\Events\Tenant;

use App\Tenants\Models\Tenant;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class TenantIdentified
{
    use Dispatchable, SerializesModels;

    public $tenant;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }
}
