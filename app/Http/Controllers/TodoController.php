<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $todos = Todo::all()->sortBy('due_date');
        $completedTodos = Todo::where('completed', true)->orderByDesc('completed_at')->get();
        return view('todos.index', compact('todos', 'completedTodos'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('todos.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        Todo::create($request->all());

        return redirect()->route('todos.index')
                         ->with('success', 'Todo created successfully.');
    }

    // Display the specified resource
    public function show(Todo $todo)
    {
        return view('todos.show', compact('todo'));
    }

    // Show the form for editing the specified resource
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    // Update the specified resource in storage
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $todo->update($request->all());

        return redirect()->route('todos.index')
                         ->with('success', 'Todo updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index')
                         ->with('success', 'Todo deleted successfully.');
    }

    public function toggleComplete(Todo $todo)
    {
        $todo->completed = !$todo->completed;
        $todo->completed_at = $todo->completed ? now() : null;
        $todo->save();

        return response()->json(['status' => 'success']);
    }
}