@extends ('layout') 
@section('content')
<form action="/article/{{$article->id}}" method="POST" class="mb-3">
    @csrf
    @method("PUT")
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" name="date" value="{{$article->date}}">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$article->name}}">
    </div>
    <div class="mb-3">
        <label for="desc" class="form-label">Description</label>
        <textarea type="text" class="form-control" id="desc" name="desc">{{$article->desc}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update article</button>
</form>
@if ($errors->any())
    <div id="toast-container">
        @foreach ($errors->all() as $error)
            <div class="toast-message alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    </div>
@endif
@endsection