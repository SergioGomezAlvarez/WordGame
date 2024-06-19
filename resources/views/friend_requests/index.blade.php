
@section('content')
<div class="container">
    <h1>Friend Requests</h1>
    <ul>
        @foreach ($requests as $request)
            <li>
                {{ $request->sender->name }}
                <form action="{{ route('friend-request.accept', $request->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Accept</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
