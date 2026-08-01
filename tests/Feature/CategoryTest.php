<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    public function test_index_can_accessed_page(): void
    {
        $response=$this->get('/categories');

        $response->assertStatus(200);
    }

    public function test_store_can_create_a_category(): void
    {
        $data=['name'=>'category99'];

        $response=$this->post('/categories',$data);

        $this->assertDatabaseHas('categories',[
            'name'=>'category99',
        ]);
        $response->assertRedirect('/categories');

        $response = $this->get('/categories');
        $response->assertStatus(200);
        $response->assertSee('category99',false);
    }

    public function test_update_can_update_category(): void
    {
        $category=Category::create(['name'=>'category50']);
        $data=['id'=>$category->id,
                'name'=>'category88'];
        
        $response=$this->patch('categories/update',$data);
        
        $this->assertDatabaseHas('categories',[
            'name'=>'category88'
        ]);
        $response->assertRedirect('/categories');
        
        $response = $this->get('/categories');
        $response->assertStatus(200);
        $response->assertSee('category88',false);
    }

    public function test_destroy_can_delete_a_category(): void
    {
        $category=Category::create(['name'=>'category99']);

        $response=$this->delete('categories/delete',['id'=>$category->id]);

        $this->assertDatabaseMissing('categories',[
            'name'=>'category99'
        ]);
        $response->assertRedirect('/categories');

        $response = $this->get('/categories');
        $response->assertStatus(200);
        $response->assertDontSee('category99',false);
    }
}