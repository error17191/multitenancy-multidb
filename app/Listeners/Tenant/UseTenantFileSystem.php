<?php

namespace App\Listeners\Tenant;

use App\Events\Tenant\TenantIdentified;
use App\Tenants\Models\Tenant;
use Illuminate\Contracts\Filesystem\Factory;

class UseTenantFileSystem
{

    protected $fileSystem;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Factory $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    /**
     * Handle the event.
     *
     * @param  TenantIdentified $event
     * @return void
     */
    public function handle(TenantIdentified $event)
    {
        $this->fileSystem->set('tenant', $this->createDrive($this->getFileSystemConfig($event->tenant)));
    }

    protected function createDrive($config)
    {
        $method = $this->getCreationMethodName();

        return $this->fileSystem->{$method}($config);
    }

    protected function getFileSystemConfig(Tenant $tenant)
    {
        $config = config('filesystems.disks' . config('filesystems.default'));

        $config['root'] = storage_path("app/{$tenant->uuid}");

        return $config;
    }

    protected function getCreationMethodName()
    {
        return 'create' . ucfirst(config('filesystems.default')) . 'Driver';
    }
}
