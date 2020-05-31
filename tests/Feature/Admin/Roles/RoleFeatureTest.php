<?php

namespace Tests\Feature\Admin\Roles;

use App\Models\Ability;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function employee_can_have_many_roles()
    {
        $employee =  factory(Employee::class)->create();

        $roleModerator = Role::create(['name'=>'moderator']);
        $roleWritter = Role::create(['name'=>'writter']);

        $employee->assignRole($roleModerator);
        $employee->assignRole($roleWritter);

        $this->assertTrue($employee->roles->contains($roleModerator));
        $this->assertTrue($employee->roles->contains($roleWritter));
    }


    /** @test */
    public function roles_can_have_many_abilities()
    {

        $roleAdmin = Role::create(['name'=>'admin']);

        $deleteAbility = Ability::Create(['name'=>'delete_post']);
        $editAbility = Ability::Create(['name'=>'edit_post']);

        $roleAdmin->allowTo($deleteAbility);
        $roleAdmin->allowTo($editAbility);

        $this->assertTrue($roleAdmin->abilities->contains($deleteAbility));
        $this->assertTrue($roleAdmin->abilities->contains($editAbility));
    }
}
