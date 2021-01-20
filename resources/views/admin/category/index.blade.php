@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header justify-content-between d-flex ">
                    <div>{{ __('Categories') }}</div>
                    <div class="button button-black" id="add">Add</div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Category</th>
                            <th>Created at</th>
                            <th colspan="2">Action</th>
                        </tr>

                        <?php foreach ($categories as $category): ?>
                            <tr class="table_row">
                                <td>{{ ucfirst($category->name) }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td><a href="{{ route('admin.category.destroy', ['category' => $category->id])}}" class="button button-black">
                                        Delete
                                    </a>
                                </td>                         
                            </tr>
                        <?php endforeach; ?>

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="bg-modal">
    <div class="modal-content">
        <div class="close">+</div>
        <h5 class="text-center">Add category</h5>
        <form method="post" id='form'>
            @csrf
            <input type="text" placeholder="category name" class="form-control" name="category" id="inputCategory">
            <div  class="button button-black" id="addCategory">Add</div>
        </form>
    </div>
</div>


@endsection
