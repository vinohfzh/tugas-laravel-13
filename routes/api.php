<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TestMiddlewareController;
use App\Jobs\SendDeadlineReminder;
use Illuminate\Support\Facades\Route;

Route::apiResource('tasks', TaskController::class);
Route::get('test-middleware', [TestMiddlewareController::class, 'index']);

// Route test queue
Route::post('test-queue', function () {
    SendDeadlineReminder::dispatch(
        taskTitle: 'Praktikum Laravel 13',
        deadline: '2026-05-20',
    )->delay(now()->addSeconds(5));

    return response()->json([
        'success' => true,
        'message' => 'Job berhasil ditambahkan ke antrian!',
        'data' => [
            'task' => 'Praktikum Laravel 13',
            'deadline' => '2026-05-20',
            'status' => 'Job dikirim ke queue, diproses dalam 5 detik',
        ]
    ]);
});