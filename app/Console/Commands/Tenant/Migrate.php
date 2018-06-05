<?php

namespace App\Console\Commands\Tenant;

use Illuminate\Database\Console\Migrations\MigrateCommand;

class Migrate extends MigrateCommand
{

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Migration for Tenants';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
