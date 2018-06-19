<?php

namespace App\Console\Commands\Tenant;

use App\Tenants\Database\DatabaseManager;
use App\Tenants\Traits\Console\AcceptsMultipleTenants;
use App\Tenants\Traits\Console\FetchesTenant;
use Illuminate\Database\Console\Seeds\SeedCommand;
use Illuminate\Database\ConnectionResolverInterface as Resolver;

class Seed extends SeedCommand
{

    use FetchesTenant, AcceptsMultipleTenants;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds Tenants Databases';

    protected $db;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Resolver $resolver, DatabaseManager $db)
    {
        parent::__construct($resolver);
        $this->setName('tenants:seed');
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

        $this->input->setOption('class', 'ProjectsTableSeeder');

        $this->tenants($this->option('tenants'))->each(function ($tenant) {
            $this->info("Migrating Tenant #{$tenant->id}");
            $this->db->createConnection($tenant);
            $this->db->connectToTenant();
            parent::handle();
            $this->db->purge();
        });

    }
}
