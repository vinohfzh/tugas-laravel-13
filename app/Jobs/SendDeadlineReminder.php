<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SendDeadlineReminder implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $taskTitle,
        public string $deadline,
    ) {}

    public function handle(): void
    {
        // Simulasi kirim notifikasi
        Log::info("=== REMINDER DEADLINE ===");
        Log::info("Tugas: {$this->taskTitle}");
        Log::info("Deadline: {$this->deadline}");
        Log::info("Notifikasi dikirim ke Vino Hafizh - XI RPL / 41");
        Log::info("=========================");
    }
}