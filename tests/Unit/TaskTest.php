<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\TodoList;
use App\Models\Task;

class TaskTest extends TestCase
{
    /**
     * Task belongs to a Todo List
     *
     * @return void
     * @test
     */
    public function task_belongs_to_todo_list()
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(TodoList::class,$task->todoList);
    }
}
