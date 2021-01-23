<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use App\Http\Requests\CreateProductRequest;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;


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

        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        Product::create([
            'name' => $request['name'],
            'slug' => $slug,
            'price' => $request['price'],
            'detales' => $request['detales'],
            'description' => $request['description'],
            'category_id' => $request['category'],
            'image' => $imagePath,
        ]);
        return redirect()->back();
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.product.index')->with('success_message', 'Product has been removed!');
    }

    // public function update(Product $product, CreateProductRequest $request)
    // {
    //     if ($request('image')) {
    //         $imagePath = request('image')->store('profile', 'public');

    //         $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
    //         $image->save();

    //         $imageArray = ['image' => $imagePath];
    //     }

    //     auth()->user()->profile->update(array_merge(
    //         $request,
    //         $imageArray ?? []
    //     ));
    //     session()->flash('success_message', 'Product information was updated.');

    //     return $product;
    // }

}
