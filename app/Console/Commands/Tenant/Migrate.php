<?php

namespace App\Console\Commands\Tenant;

use App\Company;
use App\Tenants\Database\DatabaseManager;
use Illuminate\Database\Console\Migrations\MigrateCommand;
use Illuminate\Database\Migrations\Migrator;
use Symfony\Component\Console\Input\InputOption;

class Migrate extends MigrateCommand
{

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Migration for Tenants';

    protected $db;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Migrator $migrator,DatabaseManager $db)
    {
        parent::__construct($migrator);
        $this->setName('tenants:migrate');
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

        $tenants = Company::get();
        $tenants->each(function ($tenant) {
            $this->db->createConnection($tenant);
            $this->db->connectToTenant();
            parent::handle();
            $this->db->purge();
        });

    }

    protected function getOptions()
    {
        return array_merge(
            parent::getOptions(), [
                ['tenants', null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL, '', null]
            ]
        );
    }

    protected function getMigrationPaths()
    {
        return [database_path('migrations/Tenant/')];
    }
}
