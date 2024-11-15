@extends('layout')

@section('content')
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
                    <td>{{ $article->name }}</td>
                    <td>{{ $article->desc }}</td>
                    <td>{{ $article->user_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection