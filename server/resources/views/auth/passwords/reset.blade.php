@extends('layouts.app')

@section('content')

<div id="form" class="back">
    <div class="wrapper">
        <div class="header">
            <h2>{{ __('Reset Password') }}</h2>
        </div>
        <hr />
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="fill">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="メールアドレス" required autocomplete="email" autofocus>
                @error('email')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="fill">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="パスワード" required autocomplete="new-password">
                @error('password')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                </validation-provider>
            </div>

            <div class="fil mb-4">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="確認パスワード" autocomplete="new-password" required />

            </div>
            <div class="button mb-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
</div>


@endsection