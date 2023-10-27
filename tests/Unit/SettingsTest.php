<?php

namespace Tests\Unit;

use Tests\TestCase;//always use this TestCase. Do not use TestCase from PHPUnit.
use Illuminate\Foundation\Testing\RefreshDatabase;//this will make our app to work with fake db
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

    public function test_page_loaded()
    {
        /**
         * Here we simply check if we send a get request to /settings url, will the Settings.vue
         * component be loaded.
         */
        $this->get('/settings')->assertInertia(
            fn (AssertableInertia $page) => $page->component('Settings')
        );
    }

    /**
     * Test if page is rendered by Inertia
     */
    public function test_inertia_page_loaded(): void
    {   
        /**
         * For simplicity, we manually create here a $client, that will be sent to Inertia.
         */
        $client = [
            'name' => 'Apple',
            'email' => 'steve@jobs.com',
        ];

        $this->get('/settings', $client)//send get request to /settings with a $client object
            /**
             * $page is in the Inertia top component. In Vue Dev Tool it is displayed as 
             * 'initialPage'. In Vue component it is accessible with this.$page. Finally, here in
             * Laravel it is accessible as (AssertableInertia $page).
             * 
             * fn: this is an arrow function in php, similar to JS.
             */
            ->assertInertia(fn (AssertableInertia $page) => $page//take the Inertia page
                ->component('Settings')//check if we are in the Settings.vue component
                ->has('client', fn (AssertableInertia $page) => $page//check if the component has a client property
                    ->where('name', 'Apple')//where the name is Apple
                    ->where('email', 'steve@jobs.com')//and the email is steve...
                )
            );
    }

    public function test_experimental(): void
    {
        $client = [
            'name' => 'Apple',
            'email' => 'steve@jobs.com',
        ];
        $response = $this->get('/settings', $client);
    }
}
