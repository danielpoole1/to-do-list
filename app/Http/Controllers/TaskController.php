<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller {
    // Show all tasks
    public function index() {
        $tasks = Task::get();

        return view('tasks', compact('tasks'));
    }

    // Store a new task
    public function store(Request $request) {
        $request->validate([
            'task_name' => 'required|string|max:255',
        ]);

        Task::create([
            'name' => $request->input('task_name'),
        ]);

        return redirect()->route('tasks')->with('success', 'Task created.');
    }

    // Mark as complete
    public function update(Task $task) {
        $task->completed = !$task->completed;
        $task->save();

        return redirect()->route('tasks')->with('success', 'Task updated.');
    }

    // Delete a task
    public function destroy(Task $task) {
        $task->delete();

        return redirect()->route('tasks')->with('success', 'Task deleted.');
    }
}
