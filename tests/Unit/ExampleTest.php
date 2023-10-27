<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;//do not use this
use Tests\TestCase;//use this

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    public function test_my_page_unit(): void
    {
        $response = $this->get('/settings');//TODO why is this get-> not working?

        $response->assertStatus(200);
    }
}
