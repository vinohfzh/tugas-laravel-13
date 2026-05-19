<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // GET /api/tasks
    public function index()
    {
        $tasks = Task::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data tugas berhasil diambil',
            'data' => $tasks
        ]);
    }

    // POST /api/tasks
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'in:pending,in_progress,done',
            'deadline'    => 'nullable|date',
        ]);

        $task = Task::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Tugas berhasil dibuat',
            'data'    => $task
        ], 201);
    }

    // GET /api/tasks/{id}
    public function show(Task $task)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail tugas berhasil diambil',
            'data'    => $task
        ]);
    }

    // PUT /api/tasks/{id}
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'in:pending,in_progress,done',
            'deadline'    => 'nullable|date',
        ]);

        $task->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Tugas berhasil diperbarui',
            'data'    => $task
        ]);
    }

    // DELETE /api/tasks/{id}
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tugas berhasil dihapus',
            'data'    => null
        ]);
    }
}