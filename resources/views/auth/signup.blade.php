@extends ('layout') 
@section('content')

@if ($errors->any())
    <!-- Структура Toasts -->
    <div aria-live="polite" aria-atomic="true">
        <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
            @foreach ($errors->all() as $error)
                <!-- Для каждого сообщения об ошибке создаем Toast -->
                <div class="toast align-items-center text-bg-danger border-0 mb-2" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex bg-danger">
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

<!-- Подключаем Bootstrap JS и Popper.js (для функционала Toasts) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    // Инициализация Toasts при загрузке страницы
    var toastElements = document.querySelectorAll('.toast');
    var toastList = [...toastElements].map(toastElement => new bootstrap.Toast(toastElement));
    toastList.forEach(toast => toast.show());
</script>    
<form action="/auth/register" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email addres</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">password</label>
        <input type="password" class="form-control" id="password"  name="password">
    </div>
    <button type="submit" class="btn btn-primary">signUp</button>
</form>
@endsection