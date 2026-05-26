<?php

use App\Jobs\SendDeadlineReminder;
use App\Models\Task;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Reminder otomatis: cek deadline setiap hari jam 07:00
Schedule::call(function () {
    $tasks = Task::where('status', '!=', 'done')
        ->whereNotNull('deadline')
        ->whereDate('deadline', '<=', now()->addDays(3))
        ->get();

    foreach ($tasks as $task) {
        SendDeadlineReminder::dispatch(
            taskTitle: $task->title,
            deadline: $task->deadline->format('Y-m-d'),
        );
    }
})->daily()->at('07:00')->description('Kirim reminder deadline tugas');
