<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function index(Category $category)
    {
        $products = $category->products()->with('images')->search()->productsAvailable()->get();
        return view('categories.Product.index', compact(['category', 'products']));
    }
    public function show(Category $category, Product $product)
    {
        return view('categories.Product.show', compact(['category', 'product']));
    }
}
