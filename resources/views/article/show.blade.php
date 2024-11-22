@extends ('layout') 
@section('content')
<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <strong>Author: </strong>
            {{ $user->name }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $article->name }}</h5>
            <p class="card-text">{{ $article->desc }}</p>
            <div class="d-flex justify-content-center">
                <a href="/article/{{$article->id}}/edit" class="btn btn-primary me-2">Edit article</a>
                <form action="/article/{{$article->id}}" method="POST">
                    @method("DELETE")
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete article</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection