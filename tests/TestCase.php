<?php

namespace Tests;

use App\Models\Employee;
use App\Models\Product;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Role;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $faker;
    protected $customer;
    protected $employee;
    protected $product;



    protected function setUp():void
    {
    	parent::setUp();
        // $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
        $this->faker = Faker::create();
    	$this->customer = factory(User::class)->create();
    	$this->employee = factory(Employee::class)->create();
        $this->product = factory(Product::class)->create();
    	$adminRole = Role::create([ 'guard_name'=> 'employee','name' => 'admin']);
    	$this->employee->assignRole($adminRole);




    }

    public function signInAsSuperAdmin()
    {
        $superAdmin = factory(Employee::class)->create();
        $superAdmin->assignRole(Role::create(['name'=>'super_admin','guard_name'=>'employee']));
        $this->actingAs($superAdmin,'employee');
        return $superAdmin;
    }



   

   
}
