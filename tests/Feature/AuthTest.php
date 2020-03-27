<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_it_redirects_guest_to_login_when_he_visit_home_page()
    {
        $response = $this->get('/home');

        $response->assertRedirect('/login');
    }

    public function test_it_allow_logged_in_user_to_visit_home_page()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get('/home');

        $response->assertOk();
    }
}
