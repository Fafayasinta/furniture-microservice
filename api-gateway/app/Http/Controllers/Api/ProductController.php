<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $productService = 'http://localhost:8001/api/products';

    public function index()
    {
        return Http::get($this->productService)->json();
    }

    public function store(Request $request)
    {
        return Http::post($this->productService, $request->all())->json();
    }

    public function show($id)
    {
        return Http::get("{$this->productService}/{$id}")->json();
    }

    public function update(Request $request, $id)
    {
        return Http::put("{$this->productService}/{$id}", $request->all())->json();
    }

    public function destroy($id)
    {
        return Http::delete("{$this->productService}/{$id}")->json();
    }
}

