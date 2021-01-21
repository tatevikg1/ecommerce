@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header justify-content-between d-flex ">
                    <h4>{{ __('Categories') }}</h4>
                    <div class="button button-black" id="add" style="padding: 12px 40px;">Add</div>
                </div>

                <categories-table  ref="categories"></categories-table>
            </div>
        </div>
    </div>
</div>

@include('partial._addCategoryForm')


@endsection
