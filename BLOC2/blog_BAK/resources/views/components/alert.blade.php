@if ($errors->any())
    <div class="bg-red-400">
        <ul>
            @foreach ($errors->all() as $error)
                <li><h1>{{ $error }}</h1></li>
            @endforeach
        </ul>
    </div>
@endif