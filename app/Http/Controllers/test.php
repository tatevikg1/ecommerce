<?php

namespace App\Http\Controllers;

use App\Product;


if(request()->category  && request()->onsale){

    $products = Product::wwhere('discount',  '>', '0')->whereIn('category_id', function($query){
        $query->select('id')->from('categories')->
        where('slug', request()->category)->first();
    })->get();
    $category_name =  optional($categories->where('slug', request()->category)->first())->name + "on sale" ;
    
}elseif(request()->category){

    $products = Product::whereIn('category_id', function($query){
        $query->select('id')->from('categories')->
        where('slug', request()->category)->first();
    })->get();
    $category_name = optional($categories->where('slug', request()->category)->first())->name;

}elseif(request()->onsale){

    $products = Product::where('discount',  '>', '0')->get();
    $category_name = "On Sale";

}else{
    $products = Product::all();
    $category_name = "All categories";
}