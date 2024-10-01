
@if ($errors->any())
    <div class="bg-red-400">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('post.update', $post->id) }}" method="post">
    @csrf
    @method('PUT')
    <label for="title">Títol</label>
    <input type="text" style="@error('title') border-color: RED;  @enderror"  value="{{ $post->title }}" name="title" />
    @error('title')
        <div>{{ $message }}</div>
    @enderror
    <label for="url_clean">Url neta</label>
    <input type="text" name="url_clean" value="{{ $post->url_clean }}" />
    @error('title')
        <div>{{ $message }}</div>
    @enderror
    <label for="content">Contingut</label>
    <textarea name="content" col="3" >{{ $post->content }}</textarea>
    <input type="submit" value="Editar" >
</form>