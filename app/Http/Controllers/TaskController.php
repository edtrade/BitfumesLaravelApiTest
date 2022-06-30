<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TodoList;
use App\Http\Requests\TaskStoreRequest;

class TaskController extends Controller
{
    //
    public function index(TodoList $todoList)
    {
        return $todoList->tasks;
    }
    //
    public function store(TodoList $todoList, TaskStoreRequest $request)
    {
        return $todoList->tasks()->create($request->validated());
    }

    //
    public function destroy(TodoList $todoList, Task $task)
    {
        return $task->delete();
    }
}
