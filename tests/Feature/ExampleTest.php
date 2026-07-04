<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/cp');
    }

    public function test_admin_routes_are_available_under_cp_prefix(): void
    {
        $this->get('/cp/login')->assertOk();
        $this->get('/cp/notes')->assertRedirect(route('login'));
        $this->get('/notes')->assertNotFound();
    }
}
