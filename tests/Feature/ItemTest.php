<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Models\TodoList;

class ItemTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * Get all the tasks 
     *
     * @return void
     * @test
     */
    public function get_all_tasks_of_a_todo_list()
    {
        $task = Task::factory()->create();

        $response = $this->getJson(route('todo-list.task.index',$task->todoList->id))
                    ->assertOk()
                    ->json();

        $this->assertEquals(1,count($response));

        $this->assertEquals($task->name,$response[0]['name']);      
    }

    /**
     * Create a task 
     *
     * @return void
     * @test
     */
    public function can_create_a_task()
    {
        $todoList = TodoList::factory()->create();
        $name = 'A Magical Task';
        $response = $this->postJson(route('todo-list.task.store',$todoList->id),[
            'name'  =>  $name
        ])->assertCreated();

        $this->assertDatabaseHas('tasks',['name' => $name]);
    }

    /**
     * Delete a task 
     *
     * @return void
     * @test
     */
    public function can_delete_a_task()
    {
        $task = Task::factory()->create();

        $this->deleteJson(route('task.destroy',$task->id))->assertOk();

        $this->assertDatabaseMissing('tasks',['name' => $task->name]);
    }

    /**
     * Update a task 
     *
     * @return void
     * @test
     */    
    public function can_update_a_tasl()
    {
        $task = Task::factory()->create();

        $name = $this->faker->word;

        $this->patchJson(route('task.update',$task->id),[
            'name'  => $name
        ])->assertOk();

        $this->assertDatabaseHas('tasks',['name' => $name]);
    }
}
