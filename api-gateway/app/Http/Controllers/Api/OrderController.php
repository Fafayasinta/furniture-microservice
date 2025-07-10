<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    protected $orderService = 'http://localhost:8002/api/orders';

    public function index()
    {
        return Http::get($this->orderService)->json();
    }

    public function show($id)
    {
        return Http::get("{$this->orderService}/{$id}")->json();
    }

    public function store(Request $request)
    {
        return Http::post($this->orderService, $request->all())->json();
    }

    public function update(Request $request, $id)
    {
        return Http::put("{$this->orderService}/{$id}", $request->all())->json();
    }

    public function destroy($id)
    {
        return Http::delete("{$this->orderService}/{$id}")->json();
    }
}

