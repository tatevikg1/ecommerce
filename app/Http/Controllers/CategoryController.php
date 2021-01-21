<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateCategoryRequest;


class CategoryController extends Controller
{

    public function index()
    {
        return view('admin.category.index');
    }

    public function store(CreateCategoryRequest $request)
    {
        $slug = str_replace(' ', '-', strtolower($request['category']));

        try {
            Category::create([
                'name' => $request['category'],
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
