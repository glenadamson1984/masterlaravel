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

    @unless($post['is_new'])
        <div>is is an old post using unless</div>
    @endunless

    @isset($post['has_comments'])
        <div>has comments exists</div>
    @endisset

    <h1>{{ $post['title'] }}</h1>
    <p>{{ $post['content'] }}</p>
@endsection
