@extends('layouts.app')

@section('content')
<!-- <div class="back">

    <div class="wrapper">
        <div class="header">
            <h2>{{ __('Register') }}</h2>
        </div>
        <hr>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="fill">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="名前" autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="fill">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="メールアドレス" autocomplete=" email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="fill">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="パスワード" autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="fil mb-4">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="確認パスワード" autocomplete="new-password">
            </div>




            <div class="button mb-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>

            <div class="else d-flex">
                <div class="line"></div>
                <div class="text">または</div>
                <div class="line"></div>
            </div>

            <div class="button">
                <a href="{{ route('login') }}" type="submit" class="btn btn-success">
                    {{ __('Login') }}
                </a>
            </div>



    </div>
</div> -->
<register-component :errors="{{ $errors }}" />
@endsection