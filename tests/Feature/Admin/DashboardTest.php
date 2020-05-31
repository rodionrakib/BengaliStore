<?php

namespace Tests\Feature\Admin;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function employee_can_visit_dashboard_page()
    {
        $this->withoutExceptionHandling();

        $employee = factory(Employee::class)->create();

        $this->actingAs($employee,'employee');
        $this->get('/admin/dashboard')
        ->assertSee('Dashboard')
        ->assertSee($employee->name);
    }

    /** @test */
    public function it_redirect_back_to_dashboard_to_loged_in_user_accessing_login_page()
    {
        $this->withoutExceptionHandling();

        $employee = factory(Employee::class)->create();
        
        $this->actingAs($employee,'employee');

        $this->get('/admin/login')->assertRedirect(route('admin.dashboard'));
    }
}
