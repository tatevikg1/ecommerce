<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use App\Http\Requests\CreateProductRequest;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Photo;
use Illuminate\Http\Request;

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
            'category_id' => $request['category_id'],
            'image' => $imagePath,
        ]);
        return redirect()->back();
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.product.index')->with('success_message', 'Product has been removed!');
    }

    public function edit(Product $product)
    {
        $photos = Photo::where('product_id', $product->id)->get();
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'photos', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            // to chack if it is unique compared to all products except updating product
            'name' => 'unique:products,name,' . $product->id,
            'price' => 'required',
            'detales' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);
        // if the new price is less than it was before, set discont to that procent, else set it to 0
        $discount = ($product->price > $request->price) ?  (($product->price - $request->price)*100/ $product->price) : 0;

        try {
            $request->product->update([
                'name' => $request['name'],
                'price' => $request['price'],
                'detales' => $request['detales'],
                'description' => $request['description'],
                'category_id' => $request['category_id'],
                'discount' => $discount,
            ]);
        } catch (\Throwable $th) {
            session()->flash('success_message', 'Something went wrong.');
            return redirect()->route('admin.product.index');
        }

        session()->flash('success_message', 'Product information was updated.');
        
        return redirect()->route('admin.product.index');
    }

}
