<?php

use App\Role;
use App\User;
use App\Privilege;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(app()->environment() !== 'production') {
            Role::truncate();
            User::truncate();
            $this->call(UsersTableSeeder::class);
        }
        
        Privilege::truncate();
        $this->call(PrivilegesTableSeeder::class);
    }
}
