@extends('layouts.auth')

@section('custom_css')
<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        max-width: 330px;
        padding: 15px;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>
@endsection

@section('content')

<img class="mb-4" src="/img/logo.png" alt="" width="72">
<h1 class="h3 mb-3 fw-normal">{{ config('app.name', 'Laravel') }}: {{ __('Login') }}</h1>

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-floating">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        <label for="email">{{ __('Email Address') }}</label>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-floating">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        <label for="password">{{ __('Password') }}</label>
        @error('password')
        <span class="invalid-feedback mb-2" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="checkbox mb-3">
        <label class="form-check-label" for="remember">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            {{ __('Remember Me') }}
        </label>
    </div>
    <button type="submit" class="w-100 btn btn-lg btn-primary">
        {{ __('Login') }}
    </button>
</form>
@endsection