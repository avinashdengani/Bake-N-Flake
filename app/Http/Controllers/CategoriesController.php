<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryrequest;
use App\Http\Requests\UpdateCategoryrequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Category::class);
        $categories = Category::oldest('updated_at')->paginate(8);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $this->authorize('create', Category::class);
        return view('categories.create');
    }

    public function store(CreateCategoryrequest $request)
    {
        $this->authorize('create', Category::class);
        $image = $request->file('image')->store('images/categories');
        Category::create([
            'name' => $request->name,
            'image' => $image,
            'user_id' => auth()->id(),
        ]);
        session()->flash('success', 'Category created sucessfully!');
        return redirect(route('categories.index'));
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        $this->authorize('update', $category);
        return view('categories.edit', compact(['category']));
    }

    public function update(UpdateCategoryrequest $request, Category $category)
    {
        $this->authorize('update', $category);
        $dataToUpdate = $request->only(['name']);
        if($request->hasFile('image')) {
            $image = $request->image->store('images/categories');
            $dataToUpdate['image'] = $image;
            $category->deleteImage();
        }
        $category->update($dataToUpdate);
        session()->flash('success', 'Category updated sucessfully!');
        return redirect(route('categories.index'));
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $productsCount = $category->products->count();
        if($productsCount > 0) {
            session()->flash('error', 'You can\'t delete this category as ' .$productsCount . ' product(s) belongs to this category');
            return redirect(route('categories.index'));
        }
        $category->deleteImage();
        $category->delete();
        session()->flash('success', 'Category deleted sucessfully!');
        return redirect(route('categories.index'));
    }
}
