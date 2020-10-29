<?php

use App\Models\Employee;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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
        $admin = factory(Employee::class)->create(['email'=>'sovon.kucse@gmail.com']);

        $superRole = Role::create(['name'=>'super_admin','guard_name'=>'employee']);

        Role::create(['name'=>'Editor','guard_name'=>'employee']);

        Role::create(['name'=>'Writter','guard_name'=>'employee']);

        Role::create(['name'=>'Publisher','guard_name'=>'employee']);



        $admin->assignRole($superRole);

        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);

    }
}
