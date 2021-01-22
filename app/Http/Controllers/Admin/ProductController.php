<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use App\Http\Requests\CreateProductRequest;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.product.index', compact('categories'));
    }

    public function store(CreateProductRequest $request)
    {
        $request->validated();
        $slug = str_replace(' ', '-', strtolower($request['name']));
        
        Product::create([
            'name' => $request['name'],
            'slug' => $slug,
            'price' => $request['price'],
            'detales' => $request['detales'],
            'description' => $request['description'],
            'category_id' => $request['category'],
            'image' => $request['image']
        ]);

    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.product.index')->with('success_message', 'Product has been removed!');
    }
}
