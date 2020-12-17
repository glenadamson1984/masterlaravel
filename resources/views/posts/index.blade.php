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

@endsection
