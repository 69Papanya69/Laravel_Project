@extends('layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Articles</h2>
    <table class="table table-hover table-bordered ">
        <thead class="table-dark">
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Name</th>
                <th scope="col">Short Description</th>
                <th scope="col">Description</th>
                <th scope="col">Preview Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <th scope="row">{{ $article->date }}</th>
                    <td>{{ $article->name }}</td>
                    <td>{{ $article->shortDesc }}</td>
                    <td>{{ $article->desc }}</td>
                    <td>
                        <a href="/gallery/{{$article->full_image}}/{{$article->name}}">
                            <img src="/{{$article->preview_image}}" alt="Preview Image" class="img-thumbnail"
                                style="max-width: 100px; max-height: 100px;">
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection