<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.index');
    }

    // public function store(CreateCategoryRequest $request)
    // {
       
    // }

    // public function destroy(Category $category)
    // {

    // }
}
