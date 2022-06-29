<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;

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
}
