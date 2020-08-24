<?php

namespace App\Http\Controllers;

use App\Category;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategory;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Auth::user()->categories()->get();

        return view('categories.edit', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategory $request)
    {
        $category = new Category();
        $category->category_name = $request->category_name;

        Auth::user()->categories()->save($category);

        return redirect()->route('category.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Category::find($id)->delete();

        return redirect()->route('category.create');
    }
}
