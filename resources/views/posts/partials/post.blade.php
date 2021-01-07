<div>with include we dont need to pass variable to the include</div>
<div>it just knows based on where its called in code - very smart</div>
<div>{{ $key }}.{{  $post->title }}</div>

<div>
    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Delete!">
    </form>
</div>
