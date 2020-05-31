<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Employee;
use App\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    // can see admin login page 
    use RefreshDatabase;

    
    /** @test */
    public function employee_can_be_authenticated()
    {
        $employee = factory(Employee::class)->create();

        $this->assertGuest('employee');
        
        $this->actingAs($employee,'employee');

        $this->assertAuthenticatedAs($employee,'employee');
    }

    /** @test */
    public function fornt_user_can_not_visit_dashboard_page()
    {
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();
        
        $this->actingAs($user);

        $this->get('/admin/dashboard')->assertRedirect(route('admin.login'));
    }

}
