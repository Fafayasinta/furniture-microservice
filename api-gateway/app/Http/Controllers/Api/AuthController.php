<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected $authService = 'http://localhost:8000/api';

    public function login(Request $request)
    {
        $response = Http::post("{$this->authService}/login", $request->all());
        return response()->json($response->json(), $response->status());
    }

    public function register(Request $request)
    {
        $response = Http::post("{$this->authService}/register", $request->all());
        return response()->json($response->json(), $response->status());
    }
}

