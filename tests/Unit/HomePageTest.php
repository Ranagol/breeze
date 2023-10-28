<?php

namespace Tests\Unit;

use Tests\TestCase;//use this
use Inertia\Testing\AssertableInertia;

class HomePageTest extends TestCase
{
    public function test_home_page_loaded()
    {
        /**
         * Here we simply check if we send a get request to /settings url, will the Settings.vue
         * component be loaded. This can be done in not-Inertia-way too, see the function above.
         */
        $this->get('/')->assertInertia(
            fn (AssertableInertia $page) => $page->component('Home')
        );
    }

}
