@extends ('layout') 
@section('content')
<p>{{$name}}</p>
<img src="/{{$img}}" class="img-fluid rounded-top img-thumbnail"  alt="Картинка" />
@endsection