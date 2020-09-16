@extends('layouts.app')

@section('content')

@if(session()->has('success_message'))
    <div class="alert alert-success" style="text-align:center">
        {{ Session::get('success_message') }}
    </div>
    @endif

    <div style="margin-top:10%">
        <div class="col" style="text-align:center">
            <h1>Thank You</h1>
        </div>
    </div>
@endsection
