<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $tasks = Task::all();
            return view('tasks.index', compact('tasks'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to fetch tasks..!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'completed' => 'boolean',
            ]);
    
            $task = new Task($validatedData);
            $task->user_id = Auth::id();
            $task->save();
            return redirect()->route('tasks.index')->with('success', 'Task created');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create the task..!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'completed' => 'boolean',
            ]);
            if ($task->user_id !== Auth::id()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            $task->update($validatedData);
            return redirect()->route('tasks.index')->with('success', 'Task updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update the task..!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return redirect()->route('tasks.index')->with('success', 'Task deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete the task..!');
        }
    }
}
