<?php

namespace Tests\Feature;

use App\Models\Category;
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
        $category = Category::create([
        'name' => 'テストカテゴリ'
        ]);
        $todo1 = Todo::create(['content' => 'test',
        'category_id' => $category->id,]);
        $todo2 = Todo::create(['content' => 'test2',
        'category_id' => $category->id,]);
    
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertViewIs('index');

        $response->assertViewHas('todos');

        $response->assertSee('test');
        $response->assertSee('test2');
    }

    public function test_store_can_create_a_todo(): void
    {
    $category = Category::create([
        'name' => 'テストカテゴリ'
    ]);
    $data=['content'=>'テスト用のタスクです',
        'category_id' => $category->id,];

    $response= $this->post('/todos',$data);

    $this->assertDatabaseHas('todos',[
        'content'=>'テスト用のタスクです',
    ]);
    
    $response->assertRedirect('/');

    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertSee('テスト用のタスクです',false);
}

    public function test_update_can_update_a_todo(): void
    {
        $category = Category::create([
        'name' => 'テストカテゴリ'
    ]);
        $todo=Todo::create([
            'content'=>'テスト用の更新前のタスクです',
        'category_id' => $category->id,
        ]);
    
        $data=['id'=>$todo->id,
            'content'=>'テスト用の更新タスクです',
        'category_id' => $category->id,];

        $response=$this->patch('/todos/update',$data);

        $this->assertDatabaseHas('todos',[
            'id'=>$todo->id,
            'content'=>'テスト用の更新タスクです',
        'category_id' => $category->id,
        ]);
        $response->assertRedirect('/');

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('テスト用の更新タスクです',false);
    }

    public function test_destroy_can_destroy_a_todo(): void
    {
        $category = Category::create([
        'name' => 'テストカテゴリ'
    ]);
        $todo=Todo::create([
            'content'=>'テスト用の削除前タスクです',
        'category_id' => $category->id,]);
        
        $response=$this->delete('/todos/delete',['id'=>$todo->id]);

        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id,
    ]);
        
        $response->assertRedirect('/');

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertDontSee('テスト用の削除前タスクです',false);
    }

    public function test_can_search_Todo_by_keyword(): void
    {
        
        $category=Category::create(['name'=>'テストカテゴリ']);

        $todo1=Todo::create([
            'content'=>'ゲームする','category_id'=>$category->id,
        ]);
        $todo2=Todo::create([
            'content'=>'読書する','category_id'=>$category->id
        ]);

        $response=$this->get('/todos/search?keyword=ゲーム');

        $response->assertStatus(200);
        $response->assertSee('ゲームする');
        $response->assertDontSee('読書する');
    }

    public function test_can_search_Todo_by_category(): void
    {
        $category1=Category::create(['name'=>'テストタスク']);
        $category2=Category::create(['name'=>'本番タスク']);

        $todo1=Todo::create([
            'content'=>'ゲームする','category_id'=>$category1->id
        ]);
        $todo2=Todo::create([
            'content'=>'読書する','category_id'=>$category2->id
        ]);
        $response=$this->get('/todos/search?category_id=' . $category1->id);

        $response->assertStatus(200);
        $response->assertSee('ゲームする');
        $response->assertDontSee('読書する');
    }

    public function test_can_search_Todo_by_keyword_and_category(): void
    {
        $category1=Category::create(['name'=>'カテゴリA']);
        $category2=Category::create(['name'=>'カテゴリB']);

        $todo1=Todo::create([
            'content'=>'ゲームする','category_id'=>$category1->id
        ]);
        $todo2=Todo::create([
            'content'=>'読書する','category_id'=>$category2->id
        ]);
        $response=$this->get('/todos/search?keyword=ゲーム&category_id=' . $category1->id);

        $response->assertStatus(200);
        $response->assertSee('ゲームする');
        $response->assertDontSee('読書する');
    }
}