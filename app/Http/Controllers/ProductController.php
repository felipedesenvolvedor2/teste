<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\products;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        $products = products::with('priceHistories')->paginate(5);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $produtoRequest)
    {
        $validated =  $produtoRequest->validated();
        products::create($validated);
        return redirect()->route('products.index');
    }
}
