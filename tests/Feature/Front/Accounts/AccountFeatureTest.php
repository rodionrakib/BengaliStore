<?php

namespace Tests\Feature\Front\Accounts;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountFeatureTest extends TestCase
{

    use RefreshDatabase;

      /** @test */
    public function it_shows_the_account_page_after_successful_login()
    {
        $this
            ->post(route('login'), ['email' => $this->customer->email, 'password' => 'password'])
            ->assertStatus(302)
            ->assertRedirect(route('accounts.profile'));
    }

   
}
