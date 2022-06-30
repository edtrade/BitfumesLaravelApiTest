<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\TodoList;
use App\Models\Task;

class TodoListTest extends TestCase
{
    /**
     * A Todo List Has Many Task
     *
     * @return void
     * @test
     */
    public function todo_list_has_many_tasks()
    {
        $todoList = TodoList::factory()->create();

        $todoList->tasks()->create(['name'=>'A task']);

        $todoList->tasks()->create(['name'=>'B task']);

        $this->assertEquals(2,$todoList->tasks->count());

        $this->assertInstanceOf(Task::class,$todoList->tasks->first());

    }
}
