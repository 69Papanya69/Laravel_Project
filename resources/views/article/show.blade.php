@extends('layout')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
    <div aria-live="polite" aria-atomic="true">
        <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
            @foreach ($errors->all() as $error)
                <div class="toast align-items-center text-bg-danger border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ $error }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

@section('content')
    @if (session('success'))
        <div aria-live="polite" aria-atomic="true">
            <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
                <div class="toast align-items-center text-bg-success border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div aria-live="polite" aria-atomic="true">
            <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
                <div class="toast align-items-center text-bg-danger border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="card text-center">
        <div class="card-header">
            <strong>Author: </strong>
            {{ $user->name }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $article->name }}</h5>
            <p class="card-text">{{ $article->desc }}</p>
            <div class="d-flex justify-content-center">
                <a href="{{$article->id}}/edit" class="btn btn-primary me-2">Edit article</a>
                <form action="/article/{{$article->id}}" method="POST">
                    @method("DELETE")
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete article</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="comments-section my-5">
        <h3 class="mb-4">Comments ({{ $comments->count() }})</h3>
        @forelse ($comments as $comment)
            <div class="card mb-3 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>
                        <strong>{{ $comment->user->name ?? 'Anonymous' }}</strong>
                    </span>
                    <span class="text-muted">{{ $comment->created_at->format('F d, Y \a\t H:i') }}</span>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <p class="card-text mb-0">{{ $comment->desc }}</p>
                    <div>
                        @can('update_comment', $comment)
                        <a href="/comment/{{$comment->id}}/edit" class="btn btn-primary me-2">Edit comment</a>
                        <a href="/comment/{{$comment->id}}/delete" class="btn btn-danger me-2">Delete comment</a>
                        @endcan
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No comments yet. Be the first to leave your thoughts!</p>
        @endforelse
    </div>
    <div class="add-comment-section mt-5">
        <h4 class="mb-3">Leave a Comment</h4>
        <form action="/comment" method="POST">
            @method("POST")
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Your Comment</label>
                <textarea name="desc" id="desc" rows="4" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Comment</button>
        </form>
    </div>
</div>
<script>
    // Отображение всплывающих уведомлений (toast) при ошибках и сессионных сообщениях
    document.addEventListener('DOMContentLoaded', () => {
        var toastElements = document.querySelectorAll('.toast');
        var toastList = [...toastElements].map(toastElement => new bootstrap.Toast(toastElement));
        toastList.forEach(toast => toast.show());
    });
</script>
@endsection
