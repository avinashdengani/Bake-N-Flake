<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryrequest;
use App\Http\Requests\UpdateCategoryrequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::oldest('updated_at')->paginate(8);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryrequest $request)
    {
        $image = $request->file('image')->store('images/categories');
        Category::create([
            'name' => $request->name,
            'image' => $image,
            'user_id' => auth()->id(),
        ]);
        session()->flash('success', 'Category created sucessfully!');
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact(['category']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryrequest $request, Category $category)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

    }
}
