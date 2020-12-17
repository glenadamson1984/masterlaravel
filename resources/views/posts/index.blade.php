@extends('layouts.app')

@section('title', 'posts index')

@section('content')

    @foreach($posts as $post)
        <div>{{  $post['title'] }}</div>
    @endforeach

{{--    you can also get the key in php by using the following syntax--}}
    @foreach($posts as $key => $post)
        <div>{{ $key }}.{{  $post['title'] }}</div>
    @endforeach

    {{--    for else statment so the else will be triggered in this case if no
     item in the array - we can also include break and continue directives--}}
    @forelse($posts as $key => $post)
    {{-- we break the forelse when key is 2 so only the first item is shown  --}}
    {{-- @break($key == 2)--}}
    {{-- we continue the forelse when key is 1 so only the second item is shown  --}}
        @continue($key == 1)
    <div>{{ $key }}.{{  $post['title'] }}</div>
    {{-- we also have a special variable know as $loop which you can look up in the docs--}}
    {{-- but it can we use to check counts even odd etc--}}
    @if($loop->even)
        <div style="background-color: red">index is an even number</div>
    @endif

    @empty
        <div>nothing found</div>
    @endforelse

    @for($i = 0; $i < 10; $i++)
        <div>count {{ $i }}</div>
    @endfor

    @php $done = false @endphp

    @while(!$done)
        <div>im not done</div>
        @php
        if (random_int(0, 1) === 1) $done = true
        @endphp
    @endwhile

    @foreach($posts as $key => $post)
        {{--        we also also use include and have our code in a partial page for reusability--}}
{{--        we dont need to pass the variables as its smart enough to know the variables it needs--}}
{{--        based on where its called in code. if a specific added variable is need we can pass--}}
{{--        an array as a second argument to include--}}
        @include('posts.partials.post')
    @endforeach

{{--    an alternative to using a foreach and then including a partial is an each direction--}}
{{--    with it you pass the name of the partial, the collection to iterate over, and the name of the--}}
{{--    individual item in the variable we need - its downside is it wont pass all available--}}
{{--    arguments i.e the loop variable in this case so can only be used for simpler rendering--}}
    @each('posts.partials.post', $posts, 'post')

@endsection
