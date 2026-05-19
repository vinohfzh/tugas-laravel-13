<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Attributes\Middleware;

#[Middleware('auth:sanctum')]
class TestMiddlewareController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Kamu berhasil masuk dengan Attribute Middleware!',
            'data' => [
                'user' => 'Vino Hafizh',
                'kelas' => 'XI RPL',
                'absen' => 41,
            ]
        ]);
    }
}