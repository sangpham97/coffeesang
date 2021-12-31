
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-9">
                <h3 class="h3 text-primary text-uppercase">{{$blog->title}}</h3>
                <img src="/storage/{{$blog->image}}" alt="" class="image image-fluid w-100">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-9">
                <p class="text-gray">{{$blog->desc}}</p>
            </div>
        </div>
    </div>
@endsection

