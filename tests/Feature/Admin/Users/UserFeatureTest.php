<?php

namespace Tests\Feature\Admin\Users;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserFeatureTest extends TestCase
{

    use RefreshDatabase;

    public $superAdmin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->superAdmin = factory(Employee::class)->create();
        $this->superAdmin->assignRole(Role::create(['name'=>'super_admin','label'=>'Super Admin']));    
    }

    
    /** @test */

    public function employee_can_view_users_list()
    {
        $employee = factory(Employee::class)->create();
        $employee2 = factory(Employee::class)->create();

        $this->actingAs($employee,'employee');

        $this->get('/admin/users')
        ->assertSee($employee2->name)
        ->assertSee($employee2->email);
    }

   


    /** @test */
    public function only_super_admin_or_owner_can_visit_user_edit_page()
    {
        $this->withExceptionHandling();
        // given we have a employee without role 
        $employeeToEdit = factory(Employee::class)->create();

        $user =  factory(Employee::class)->create();  

        $this->actingAs($user,'employee');
        // when he try to visit edit page 
        $this->get(route('admin.users.edit',['user'=>$employeeToEdit->id]))
        ->assertStatus(403);

        $this->actingAs($this->superAdmin,'employee');

        $this->get(route('admin.users.edit',['user'=>$employeeToEdit->id]))
        ->assertStatus(200);

        $this->actingAs($employeeToEdit,'employee');

        $this->get(route('admin.users.edit',['user'=>$employeeToEdit->id]))
        ->assertStatus(200);

        

        // it should be forbidden 
    }
  

    /** @test */
    public function super_admin_can_update_the_user()
    {
        $this->withoutExceptionHandling();

        $employee = factory(Employee::class)->create(['status'=> 0]);

        $roleOne =  Role::create([ 'name'=> 'writter']);
        $roleTwo =  Role::create([ 'name'=> 'editor']);

        $this->actingAs($this->superAdmin,'employee');

        $this->put(route('admin.users.update',['user'=>$employee->id]),[
            'name' => 'Rodion',
            'address' => 'Fulbari,Khulna',
            'status' => 1,
            'roles' => [$roleOne->id,$roleTwo->id],
        ]);
        
       $employee = $employee->fresh();

        $this->assertEquals('Rodion',$employee->name);
        $this->assertEquals(1,$employee->status);
        $this->assertEquals('Fulbari,Khulna',$employee->address);

        $this->assertTrue( $employee->roles->contains($roleOne));
        $this->assertTrue( $employee->roles->contains($roleTwo));

    }




}
