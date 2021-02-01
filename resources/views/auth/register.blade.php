@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        @foreach($errors->all() as $error)
            {{ $error  }}
        @endforeach

        <div class="form-group">
            <label>Name</label>
            <input name="name" value="{{ old('name') }}" required class="form-control"/>

            @if($errors->has('name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif

        </div>

        <div class="form-group">
            <label>Email</label>
            <input name="email" value="{{ old('email') }}" required class="form-control"/>
            @if($errors->has('email'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label>Password</label>
            <label>
                <input name="password" required class="form-control" type="password" {{ $errors->has('password') ? ' is-invalid': ''}}/>
            </label>
            @if($errors->has('password'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label>Retyped Password</label>
            <input name="password_confirmation" required class="form-control" type="password" />
        </div>

        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>
@endsection('content')
