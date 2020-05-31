<?php

use App\Models\Employee;
use App\Models\Role;
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
        // $this->call(UsersTableSeeder::class);

        $admin = factory(Employee::class)->create(['name'=>'Admin']);

        $superRole = Role::create(['name'=>'super_admin','label'=>'Super Admin']);

        $admin->assignRole($superRole);
        
        factory(Employee::class,5)->create();

    }
}
