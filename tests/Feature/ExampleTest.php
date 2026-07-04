<?php

namespace Tests\Feature;

use App\Models\Catalog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_homepage_displays_catalog_list(): void
    {
        Catalog::create(['name' => 'Тестовая категория']);

        $this->get('/')
            ->assertOk()
            ->assertSee('Каталог')
            ->assertSee('Тестовая категория');
    }

    public function test_admin_routes_are_available_under_cp_prefix(): void
    {
        $this->get('/cp/login')->assertOk();
        $this->get('/cp/notes')->assertRedirect(route('login'));
        $this->get('/notes')->assertNotFound();
    }
}
