<?php

namespace App\Http\Controllers;

use App\Http\Requests\products\CreateProductRequest;
use App\Http\Requests\products\UpdateProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Product::class);
        $products = Product::with("images")->oldest('updated_at')->paginate(8);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', Product::class);
        $categories = Category::all();
        return view('products.create', compact(['categories']));
    }

    public function store(CreateProductRequest $request)
    {
        $this->authorize('create', Product::class);
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
        $this->authorize('view', $product);
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $categories = Category::all();
        return view('products.edit', compact(['product','categories']));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        $data = $request->only('category_id', 'user_id', 'name', 'description', 'mrp', 'discount', 'status' );

        $discount = $request->discount;
        $mrp = $request->mrp;
        $selling_price = $mrp - ($mrp*$discount)/100;
        $data['selling_price'] = $selling_price;
        $product->update($data);

        if($request->has('image')) {
            foreach($product->images as $image) {
                $image->delete();
                $image->deleteImage();
            }
            foreach($request->image as $image){
                $img = $image->store("images/products");
                Image::create([
                    'image' => $img,
                    'product_id' => $product->id
                ]);
             }
        }
        session()->flash('success', 'Product updated sucessfully!');
        return redirect(route('products.index'));
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        foreach($product->images as $image) {
            $image->delete();
            $image->deleteImage();
        }
        $product->delete();
        session()->flash('success', 'Product deleted sucessfully!');
        return redirect(route('products.index'));
    }
}
