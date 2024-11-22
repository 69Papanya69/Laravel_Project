@extends('layout')

@section('content')
@use('App\Models\User', 'User')
@if (session('status'))
    <div class="toast-message alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container mt-4">
    <h2 class="mb-4 text-center">Articles</h2>
    <table class="table table-hover table-bordered ">
        <thead class="table-dark">
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Authon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
            <tr>
                <th scope="row">{{ $article->date }}</th>
                <td><a href="/article/{{ $article->id }}">{{ $article->name }}</a></td>
                <td>{{ $article->desc }}</td>
                <td>{{User::findOrFail($article->user_id)->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $articles->links() }}
</div>
@endsection