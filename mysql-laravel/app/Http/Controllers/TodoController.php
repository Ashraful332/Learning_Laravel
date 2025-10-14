<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Todo;

class TodoController extends Controller
{
     // সব todo দেখানো
    public function index()
    {
        $todos = Todo::orderBy('created_at', 'desc')->get();
        return view('todos.index', compact('todos'));
    }

    // নতুন todo তৈরির ফর্ম
    public function create()
    {
        return view('todos.create');
    }

    // নতুন todo সেভ করা
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable'
        ]);

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => false
        ]);

        return redirect()->route('todos.index')
            ->with('success', 'Todo সফলভাবে তৈরি হয়েছে!');
    }

    // todo edit করার ফর্ম
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    // todo আপডেট করা
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable'
        ]);

        $todo->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->route('todos.index')
            ->with('success', 'Todo আপডেট হয়েছে!');
    }

    // todo ডিলিট করা
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')
            ->with('success', 'Todo মুছে ফেলা হয়েছে!');
    }

    // todo complete/incomplete করা
    public function toggleComplete(Todo $todo)
    {
        $todo->update([
            'is_completed' => !$todo->is_completed
        ]);

        return redirect()->route('todos.index');
    }
}
