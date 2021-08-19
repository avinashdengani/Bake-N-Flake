<?php

namespace App\Http\Controllers;

use App\Http\Requests\Images\UpdateImageRequest;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
class ImagesController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Image $image)
    {
        //
    }

    public function edit(Product $product, Image $image)
    {
        $this->authorize('update', $image);
        return view('images.edit', compact(['image', 'product']));
    }

    public function update(UpdateImageRequest $request, Product $product, Image $image)
    {
        $this->authorize('update', $image);
        $img = $request->image->store("images/products");
        $image->deleteImage();
        $image->update([
            'image' => $img
        ]);
        session()->flash('success', 'Image updated sucessfully!');
        return redirect(route('products.index'));
    }

    public function destroy(Product $product, Image $image)
    {
        $this->authorize('delete', $image);
        if($product->images->count() <= 1) {
            session()->flash('error', 'You can\'t delete this image as this is the only image.');
            return redirect(route('products.index'));
        }
        $image->deleteImage();
        $image->delete();

        session()->flash('success', 'Image deleted sucessfully!');
        return redirect(route('products.index'));
    }
}
