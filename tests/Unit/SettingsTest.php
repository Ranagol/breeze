<?php

namespace Tests\Unit;

use Tests\TestCase;//always use this TestCase. Do not use TestCase from PHPUnit.
use Illuminate\Foundation\Testing\RefreshDatabase;//this will make our app to work with fake db
use Inertia\Testing\Assert;
use Inertia\Testing\AssertableInertia;

class SettingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Basic page loading test, nothing fancy. Simple PHPUnit.
     */
    public function test_settings_page_can_be_rendered(): void
    {
        $response = $this->get('/settings');

        $response->assertStatus(200);
    }

    /**
     * Test if page is rendered by Inertia
     */
    public function test_inertia_page_loaded(): void
    {
        $client = [
            'name' => 'Apple',
            'email' => 'steve@jobs.com',
        ];

        $this->get('/settings', $client)
            ->assertInertia(fn (AssertableInertia $page) => $page
                ->component('Settings')
                ->has('client', fn (AssertableInertia $page) => $page
                    ->where('name', 'Apple')
                    ->where('email', 'steve@jobs.com')
                )
            );
    }
}
