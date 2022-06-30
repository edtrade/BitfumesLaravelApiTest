<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\TodoList;

class TodoListTest extends TestCase
{

    private $count = 10;
    private $todoLists;

    public function setUp():void
    {
        parent::setUp();
        $this->todoLists = TodoList::factory($this->count)->create();
    }

    /**
     * can get all todo lists
     *
     * @return void
     * @test
     */
    public function can_get_all_todo_lists()
    {
     
        //perform
        $response = $this->getJson(route('todo-list.index'));   

        //predict
        $response->assertStatus(200);

        $this->assertEquals($this->count, count($response->json()));

    }

    /**
     * can get todo list by id
     *
     * @return void
     * @test
     */
    public function can_get_todo_list_by_id()
    {

        //perform
        //better readable
        $response = $this->getJson(route('todo-list.show',$this->todoLists[0]->id))
                    ->assertOk()
                    ->json();
        //predict
        $this->assertEquals($this->todoLists[0]->name, $response['name']);
    }
    
    /**
     * check todo list that doesnt exist
     *
     * @return void
     * @test
     */
    public function check_todo_doesnt_exist()
    {
        // 
        $response = $this->getJson(route('todo-list.show',100))->assertNotFound();     
    } 

    /**
     * test todo list store
     *
     * @return void
     * @test
     */   
    public function can_store_a_todo_list()
    {
        //
        $name = "A Magical List";

        //
        $response = $this->postJson(route('todo-list.store'),[
            'name' => $name
        ])
        ->assertCreated()
        ->json();

        //
        $this->assertEquals($name,$response['name']);

        $this->assertDatabaseHas('todo_lists',['name'=>$name]);
    }

    /**
     * test todo list store requires a name
     *
     * @return void
     * @test
     */
    public function create_todo_list_name_is_required()
    {
        $response = $this->postJson(route('todo-list.store'))->assertUnprocessable();

        $response->assertJsonValidationErrors(['name']);
    }   

    /**
     * test can delete todo list
     *
     * @return void
     * @test
     */    
    public function can_delete_a_todo_list()
    {
        $this->deleteJson(route('todo-list.destroy',$this->todoLists[0]->id))->assertOk();
    }

    /**
     * test can update todo list
     *
     * @return void
     * @test
     */     
    public function can_update_a_todo_list()
    {
        $name = 'Updated Name';
        $this->patchJson(route('todo-list.update',$this->todoLists[0]->id),['name'=>$name])->assertOk();

        $this->assertDatabaseHas('todo_lists',['name'=>$name]);

    }
    /**
     * test can update todo list
     *
     * @return void
     * @test
     */     
    public function update_todo_list_name_is_required()
    {
        $this->patchJson(route('todo-list.update',$this->todoLists[0]->id))->assertJsonValidationErrors(['name']);
    }    
    
}
