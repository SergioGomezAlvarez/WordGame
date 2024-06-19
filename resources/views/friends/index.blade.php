
@section('content')
<div class="container">
    <h1>Your Friends</h1>
    <ul>
        @foreach ($friends as $friend)
            <li>{{ $friend->name }}</li>
        @endforeach
    </ul>
</div>
