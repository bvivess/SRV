
@if ($errors->any())
    <div class="bg-red-400">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('category.store') }}" method="post">
    @csrf
    <label for="title">Títol</label>
    <input type="text" style="@error('title') border-color: RED;  @enderror"  name="title" />
    @error('title')
        <div>{{ $message }}</div>
    @enderror
    <label for="url_clean">Url neta</label>
    <input type="text" name="url_clean" />
    @error('title')
        <div>{{ $message }}</div>
    @enderror
    <input type="submit" value="Crear" >
</form>