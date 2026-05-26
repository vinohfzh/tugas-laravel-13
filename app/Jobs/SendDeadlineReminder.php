<?php

namespace App\Jobs;

use Carbon\Carbon;
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
        $deadlineDate = Carbon::parse($this->deadline);
        $daysLeft = now()->diffInDays($deadlineDate, false);

        // Tentukan level urgensi
        if ($daysLeft < 0) {
            $urgency = '🔴 TERLAMBAT';
            $message = 'Sudah terlambat ' . abs($daysLeft) . ' hari!';
        } elseif ($daysLeft === 0) {
            $urgency = '🟠 HARI INI';
            $message = 'Deadline hari ini!';
        } elseif ($daysLeft <= 1) {
            $urgency = '🟡 BESOK';
            $message = 'Deadline besok!';
        } else {
            $urgency = '🟢 SEGERA';
            $message = $daysLeft . ' hari lagi menuju deadline.';
        }

        // Simulasi kirim notifikasi
        Log::info("=== REMINDER DEADLINE ===");
        Log::info("Tugas: {$this->taskTitle}");
        Log::info("Deadline: {$this->deadline}");
        Log::info("Status: {$urgency} - {$message}");
        Log::info("Notifikasi dikirim ke Vino Hafizh - XI RPL / 41");
        Log::info("=========================");
    }
}