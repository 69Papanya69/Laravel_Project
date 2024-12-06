@extends('layout')
@section('content')
@use('App\Models\User', 'User')
@use('App\Models\Article', 'Article')
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<table class="table table-hover table-bordered ">
    <thead class="table-dark">
        <th scope="col">Date</th>
        <th scope="col">Article Name</th>
        <th scope="col">Description</th>
        <th scope="col">Author</th>
        <th scope="col">Accept/Reject</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Comments as $comment)
            <tr>
                <th scope="row">{{$comment->created_at}}</th>
                <td><a href="/article/{{ $comment->article_id }}">{{Article::findOrFail($comment->article_id)->name}}</a>
                </td>
                <td>{{$comment->desc}}</td>
                <td>{{ User::findOrFail($comment->user_id)->name }}</td>
                <td class="text-center">
                    @if(!$comment->accept)
                        <a href="/comment/{{$comment->id}}/accept" class="btn btn-success">Accept</a>
                    @else
                        <a href="/comment/{{$comment->id}}/reject" class="btn btn-danger">Reject</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection