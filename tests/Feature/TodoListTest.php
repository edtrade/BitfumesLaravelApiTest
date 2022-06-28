<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TodoList;
class TodoListTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function can_get_todo_list()
    {

        //prepare
        $count = 10;
        TodoList::factory($count)->create();
       
        //perform
        $response = $this->getJson('/api/todo-list');        

        //dd($response->json());
        //predict
        $response->assertStatus(200);

        $this->assertEquals($count, count($response->json()));
    }
}
