<?php

use App\Http\Controllers\TaskWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::resource('tasks', TaskWebController::class);
Route::get('/csrf-info', function () {
    return response()->json([
        'success' => true,
        'message' => 'Security Info',
        'data' => [
            'fitur' => 'PreventRequestForgery',
            'csrf_token' => csrf_token(),
            'keterangan' => 'Laravel 13 menggunakan PreventRequestForgery untuk melindungi aplikasi dari serangan CSRF',
            'perbedaan' => [
                'laravel_12' => 'Menggunakan VerifyCsrfToken middleware class',
                'laravel_13' => 'Menggunakan validateCsrfTokens() di bootstrap/app.php',
            ]
        ]
    ]);
});