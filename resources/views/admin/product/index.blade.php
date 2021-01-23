@extends('layouts.app')
@section('title', 'Admin Product')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header justify-content-between d-flex ">
                    <h4>{{ __('Products') }}</h4>
                    <div class="button button-black" id="addProduct" style="padding: 12px 40px;">Add</div>
                </div>

                <products-table  ref="products"></products-table>
            </div>
        </div>
    </div>
</div>

@include('admin.product._addProductForm')

@endsection
