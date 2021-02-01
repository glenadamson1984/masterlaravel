@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label>Name</label>
            <input name="name" value="{{ old('name') }}" required class="form-control"/>
        </div>
        @if($errors->has('name'))
            <label>{{$errors->first('name')}}</label>
        @endif

        <div class="form-group">
            <label>Email</label>
            <input name="email" value="{{ old('email') }}" required class="form-control"/>
        </div>
        @if($errors->has('email'))
            <label>{{$errors->first('email')}}</label>
        @endif

        <div class="form-group">
            <label>Password</label>
            <label>
                <input name="password" required class="form-control" type="password" {{ $errors->has('password') ? ' is-invalid': ''}}/>
            </label>
        </div>
        @if($errors->has('password'))
            <label>{{$errors->first('password')}}</label>
        @endif

        <div class="form-group">
            <label>Retyped Password</label>
            <input name="password_confirmation" required class="form-control" type="password" />
        </div>

        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>
@endsection('content')
