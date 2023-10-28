<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Inertia\Testing\AssertableInertia;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;


class UserTest extends TestCase
{
    use RefreshDatabase;

    public Collection $users;
    public User $user;

    protected function setUp(): void
    {
        parent::setUp();//Here we call the parent's setUp() first, which is mandatory

        //We create a fake user with factory, for logging in.
        $this->users = User::factory(10)->create();
        $this->user = User::factory()->create();

    }

    public function test_user_page_not_loading_for_guest(): void
    {
        $response = $this->get('/users');

        /**
         * asserts that the response has a status code of 302 (a redirect response). Redirect, 
         * because the guest/non-authenticated-user is not allowed to access /users page.
         */
        $response->assertStatus(302);

        // guests are redirected to the login page.
        $response->assertRedirect('login');
    }

    public function test_user_page_loads_for_logged_in_user(): void
    {
        $response = $this->actingAs($this->user)->get('/users');

        $response->assertOk();//Assert that the response has a 200 HTTP status code:

    }

    public function test_users_page_has_users_displayed(): void
    {
        $this->actingAs($this->user)->get('/users')->assertInertia(
            fn(AssertableInertia $page) => $page->component('Users/Index')->has('users')
        );
    }

}
