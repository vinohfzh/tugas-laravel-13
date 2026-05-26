<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskWebController extends Controller
{
    // GET /tasks
    public function index()
    {
        $tasks = Task::latest()->get();

        $stats = [
            'total'       => $tasks->count(),
            'pending'     => $tasks->where('status', 'pending')->count(),
            'in_progress' => $tasks->where('status', 'in_progress')->count(),
            'done'        => $tasks->where('status', 'done')->count(),
            'overdue'     => $tasks->filter(function ($task) {
                return $task->deadline && $task->deadline->isPast() && $task->status !== 'done';
            })->count(),
        ];

        return view('tasks.index', compact('tasks', 'stats'));
    }

    // GET /tasks/create
    public function create()
    {
        return view('tasks.create');
    }

    // POST /tasks
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'in:pending,in_progress,done',
            'deadline'    => 'nullable|date',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil ditambahkan!');
    }

    // GET /tasks/{task}
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    // GET /tasks/{task}/edit
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // PUT /tasks/{task}
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'in:pending,in_progress,done',
            'deadline'    => 'nullable|date',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui!');
    }

    // DELETE /tasks/{task}
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus!');
    }
}
