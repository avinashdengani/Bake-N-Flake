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
        $categories = Category::all();
        return view('products.create', compact(['categories']));
    }

    public function store(CreateProductRequest $request)
    {
        $discount = $request->discount;
        $mrp = $request->mrp;
        $selling_price = $mrp - ($mrp*$discount)/100;
        $product = Product::create([
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'mrp' => $mrp,
            'selling_price' => $selling_price,
            'discount' => $discount,
            'status' => $request->status,
        ]);
        foreach($request->image as $image){
           $img = $image->store("images/products");
           Image::create([
               'image' => $img,
               'product_id' => $product->id
           ]);
        }
        session()->flash('success', 'Product added sucessfully!');
        return redirect(route('products.index'));
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact(['product','categories']));
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
