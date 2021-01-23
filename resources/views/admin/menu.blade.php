@extends('layouts.app')
@section('title', 'Admin Menu')

@section('content')
<div class="container mt-5">
    <div class="d-flex flex-wrap admin-menu-container justify-content-around">
        <div class="m-3">
            <a href="{{ route('admin.category.index') }}">
                <h4 class="admin-menu-item">
                    Categories
                </h4>
            </a> 
        </div>
        

        <div class="m-3">
            <a href="{{ route('admin.product.index') }}">
                <h4 class="admin-menu-item">
                    Products
                </h4>
            </a> 
        </div>

        <div class="m-3">
            <a href="{{ route('admin.category.index') }}">
                <h4 class="admin-menu-item">
                    Customers
                </h4>
            </a> 
        </div>

    </div>
</div>
@endsection
