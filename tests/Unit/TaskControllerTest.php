<?php

namespace Tests\Unit;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $tasks = factory(Task::class)->times(3)->create();
        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
        foreach ($tasks as $task) {
            $response->assertSee($task->title);
        }
    }

    public function testCreate()
    {
        $response = $this->get(route('tasks.create'));
        $response->assertStatus(200);
        $response->assertSee('Create Task');
    }

    public function testStore()
    {
        $taskData = [
            'title' => 'Fake Title',
            'description' => 'This is a fake test task.',
            'completed' => false,
        ];
        $response = $this->post(route('tasks.store'), $taskData);
        $this->assertDatabaseHas('tasks', $taskData);
        $response->assertRedirect(route('tasks.index'));
    }

    public function testEdit()
    {
        $task = factory(Task::class)->create();
        $response = $this->get(route('tasks.edit', $task));
        $response->assertStatus(200);
        $response->assertSee('Edit Task');
    }

    public function testUpdate()
    {
        $task = factory(Task::class)->create();
        $updatedTaskData = [
            'title' => 'Updated Test Task',
            'description' => 'This is an updated test task.',
            'completed' => true,
        ];
        $response = $this->put(route('tasks.update', $task), $updatedTaskData);
        $this->assertDatabaseHas('tasks', $updatedTaskData);
        $response->assertRedirect(route('tasks.index'));
    }

    public function testDestroy()
    {
        $task = factory(Task::class)->create();
        $response = $this->delete(route('tasks.destroy', $task));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
        $response->assertRedirect(route('tasks.index'));
    }
}