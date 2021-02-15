<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.category.index');
    }

    public function store(CreateCategoryRequest $request)
    {
        $slug = str_replace(' ', '-', strtolower($request['name']));

        try {
            Category::create([
                'name' => $request['name'],
                'slug' => $slug
            ]);
        } catch (\Exception $e) {
    
            return response($e->getMessage(), 422)->header('Content-Type', 'text/plain');
        }
        return response('Category was added', 200)->header('Content-Type', 'text/plain');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index')->with('success_message', 'Category has been removed!');
    }
}
