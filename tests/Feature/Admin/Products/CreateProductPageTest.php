<?php

namespace Tests\Feature\Admin\Products;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateProductPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_should_not_show_to_customers()
    {
        $this->actingAs($this->customer, 'web');
        $this->get(route('admin.products.create'))
            ->assertSessionHas(['error' => 'You must be an employee to see this page'])
            ->assertRedirect(route('admin.login'));
    }

        /** @test */
    public function it_should_not_show_to_employees_without_any_role()
    {
        $employee = factory(Employee::class)->create();

        $this
            ->actingAs($employee, 'employee')
            ->get(route('admin.products.create'))
            ->assertStatus(403)
            ->assertSee('User does not have the right roles.');
    }


    /** @test */
    public function it_should_show_to_admin_role()
    {
        $this->withoutExceptionHandling();
        $this
            ->actingAs($this->employee, 'employee')
            ->get(route('admin.products.create'))
            ->assertStatus(200);
    }


        /** @test */
    public function it_should_not_show_to_non_admin_role()
    {
        $employee = factory(Employee::class)->create();

        $dealer = Role::create([ 'guard_name' => 'employee','name' => 'user']);

        $employee->assignRole($dealer);

        $this
            ->actingAs($employee, 'employee')
            ->get(route('admin.products.create'))
            ->assertStatus(403)
            ->assertSee('User does not have the right roles.');
    }


}
