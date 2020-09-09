<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ShopController extends Controller
{

    public function index()
    {
        $products = Product::all();
        $categories = Category::all();

        return view('shop.index' , compact('products', 'categories'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($product)
    {
        $products = Product::inRandomOrder()->take(4)->get();
        $product = Product::where('slug', $product)->first();


        return view('shop.show', compact('product', 'products'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
