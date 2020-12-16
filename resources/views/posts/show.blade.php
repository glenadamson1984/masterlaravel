@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    @if($post['is_new'])
        <div>This is a new blogpost</div>
{{--        can use else for non booleans but in this case we are looking at a bool so else is fine--}}
{{--        @elseif(!$post['is_new'])--}}
{{--        <div>well this must be an old blogpost then</div>--}}
    @else
        <div>well this must be an old blogpost then</div>
    @endif

    <h1>{{ $post['title'] }}</h1>
    <p>{{ $post['content'] }}</p>
@endsection
