<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;
use App\Http\Requests\TodoListStoreRequest;

class TodoListController extends Controller
{
    //
    public function index()
    {
        return TodoList::all();
    }

    //
    public function show(TodoList $todoList)
    {
        return $todoList;
    }

    //
    public function store(TodoListStoreRequest $request)
    {

        return TodoList::create($request->validated());

    }

    //
    public function update(TodoList $todoList, TodoListStoreRequest $request)
    {
        return $todoList->update($request->validated());
    }

    //
    public function destroy(TodoList $todoList)
    {
        $todoList->delete();
    }
}
