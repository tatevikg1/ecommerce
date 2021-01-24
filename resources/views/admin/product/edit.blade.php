@extends('layouts.app')
@section('title', 'Admin Product')

@section('content')
<div class="container mt-5">
    <div class="d-flex flex-wrap admin-menu-container justify-content-around">
    <form  enctype="multipart/form-data" method="POST" id="updateProductForm" action="{{ route('admin.product.update', $product->id) }}">
            @csrf
            @method('PATCH')

            <input type="hidden" name="product_id" value="{{ $product->id }}" id="product_id">

            <div class="d-flex justify-content-between">
                <div class="">
                    <label for="name">Product name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') ?? $product->name }}"  class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" value="{{ old('price') ?? $product->price }}" class="form-control  @error('price') is-invalid @enderror" required>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="detales">Detales</label>
                <input type="text" id="detales" name="detales" value="{{ old('detales') ?? $product->detales }}" class="form-control  @error('detales') is-invalid @enderror" required>
                @error('detales')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" value="{{ old('description') ?? $product->description }}" class="form-control  @error('description') is-invalid @enderror" rows="4" cols="50" required>
                    @if ( old('description') )  {{ old('description') }}  @else  {{ $product->description }}   @endif
                </textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
           
            <div class="form-group">
                <label class="my-1 mr-2" for="category">Select category</label>
                <select id="category_id" name="category_id" class="form-control  @error('category_id') is-invalid @enderror">
                    @foreach($categories  as $category)
                        <option value="{{ $category->id }}"
                            @if ($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <uploaded-images product="{{ $product->id }}"></uploaded-images>

            <input type="submit" class="button button-black d-inline-flex p-2" value="Update">
            <!-- <div  class="button button-black d-inline-flex p-2" id="updateProduct">Update</div> -->
        </form>
    </div>
</div>
@endsection
