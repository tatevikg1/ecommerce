<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();

        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $res = $request->validate([
            'category' => 'required|unique:categories',
        ]);

        $slug = str_replace(' ', '-', strtolower($request['category']));
        
        try {
            Category::create([
                'name' => $request['category'],
                'slug' => $slug
            ]);
        } catch (\Exception $e) {
            
            return response($e->getMessage(), 200)->header('Content-Type', 'text/plain');
        }


        return response('Category was added', 200)->header('Content-Type', 'text/plain');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index')->with('success_message', 'Category has been removed!');
    }
}
