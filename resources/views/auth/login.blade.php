@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

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
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember"
                       value="{{ old('remember') ? 'checked': '' }}"/>
                <label class="form-check-label" for="remember">
                    Remember Me
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Log in</button>
    </form>
@endsection('content')
