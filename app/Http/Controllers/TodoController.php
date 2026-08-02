<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Todo;
class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        $categories=Category::all();
        
        return view('index',compact('todos','categories'));
    }

    public function store(TodoRequest $request)
    {
        $Todo=$request->only('content','category_id');
        Todo::create($Todo);

        return redirect('/')->with('message','Todoを作成しました');
    }

    public function update(TodoRequest $request)
    {
        $Todo=$request->only('content');
        Todo::find($request->id)->update($Todo);

        return redirect('/')->with('message','Todoを更新しました');
    }

    public function destroy(Request $request)
    {
        Todo::destroy($request->id);

        return redirect('/')->with('message','Todoを削除しました');
    }
}
