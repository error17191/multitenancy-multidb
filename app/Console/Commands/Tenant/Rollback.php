<?php

namespace App\Console\Commands\Tenant;

use App\Tenants\Database\DatabaseManager;
use App\Tenants\Traits\Console\AcceptsMultipleTenants;
use App\Tenants\Traits\Console\FetchesTenant;
use Illuminate\Database\Console\Migrations\RollbackCommand;
use Illuminate\Database\Migrations\Migrator;

class Rollback extends RollbackCommand
{
    use FetchesTenant, AcceptsMultipleTenants;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback Migration for Tenants';

    protected $db;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Migrator $migrator, DatabaseManager $db)
    {
        parent::__construct($migrator);
        $this->setName('tenants:rollback');
        $this->specifyParameters();
        $this->db = $db;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->confirmToProceed()) {
            return;
        }

        $this->input->setOption('database', 'tenant');

        $this->tenants($this->option('tenants'))->each(function ($tenant) {
            $this->info("Migrating Tenant #{$tenant->id}");
            $this->db->createConnection($tenant);
            $this->db->connectToTenant();
            parent::handle();
            $this->db->purge();
        });
    }

    protected function getMigrationPaths()
    {
        return [database_path('migrations/Tenant/')];
    }

}
