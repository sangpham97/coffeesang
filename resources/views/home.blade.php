@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-8">
        <h1 class="text-warning">Add your compliment here</h1>
        <form action="/createreview" class="mt-4" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-group">
                <label >Comment:</label>
                <textarea class="form-control"  rows="3" placeholder="Leave your comment" name="comment"></textarea>
            </div>
            <div class="form-group">
                <label >Rating:</label>
                <input class="form-control" name='rating' type="number" max="5" min="1">
            </div>
            <div class="form-group">
                <label >Your Avatar:</label>
                <input class="form-control" name="image" type='file'>
            </div>
            <button class="btn btn-success">Post</button>
        </form>
    </div>
</div>
</div>
@endsection
