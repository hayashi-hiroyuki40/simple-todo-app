<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Todo;
class TodoTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_index_page_can_be_accessed(): void
    {
        $todo1 = Todo::create(['content' => 'test']);
        $todo2 = Todo::create(['content' => 'test2']);
    
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertViewIs('index');

        $response->assertViewHas('todos');

        $response->assertSee('test');
        $response->assertSee('test2');
    }
}
