<?php

namespace App\Http\Controllers;

use App\Http\Requests\products\CreateProductRequest;
use App\Http\Requests\products\UpdateProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with("images")->oldest('updated_at')->paginate(4);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
