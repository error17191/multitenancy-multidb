<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Company;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Mohamed Ahmed',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $company = Company::create([
            'name' => 'NoisyState'
        ]);

        $user->companies()->attach($company);
    }
}
