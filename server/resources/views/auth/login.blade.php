@extends('layouts.app')

@section('content')
<!-- <div class="back">

    <div class="wrapper">
        <div class="header">
            <h2>{{ __('Login') }}</h2>
        </div>
        <hr>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="fill">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="メールアドレス" autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="fill">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="パスワード" autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="fill mb-3">
                <input class="check" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <div class="button mb-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
            </div>

            @if (Route::has('password.request'))
            <a class="forget btn btn-link text-center" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif

            <div class="else d-flex">
                <div class="line"></div>
                <div class="text">または</div>
                <div class="line"></div>
            </div>

            <div class="button">
                <a href="{{ route('register') }}" type="submit" class="btn btn-success">
                    {{ __('Register') }}
                </a>
            </div>



    </div>
</div> -->
<login-component :errors="{{ $errors }}" />

@endsection