<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use Illuminate\Http\Request;
use App\Models\Todo;
class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        
        return view('index',compact('todos'));
    }

    public function store(TodoRequest $request)
    {
        $Todo=$request->only('content');
        Todo::create($Todo);

        return redirect('/')->with('message','Todoを作成しました');
    }

    public function update(TodoRequest $request)
    {
        $Todo=$request->only('content');
        Todo::find($request->id)->update($Todo);

        return redirect('/')->with('message','Todoを更新しました');
    }
}
