@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="register-container">
        <h1 class="site-title">PiGLy</h1>
        <h2 class="container-title">ログイン</h2>

        <form class="form" action="/admin" method="post">
            @csrf
            <div class="form-list">
                <div class="form-item">
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" placeholder="メールアドレスを入力">
                </div>
                @error('email')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror

                <div class="form-item">
                    <label for="password">パスワード</label>
                    <input type="text" name="password" placeholder="パスワードを入力">
                </div>
                @error('password')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="button-container">
                <button type="submit" class="next-button">ログイン
                </button>
            </div>
            <a href="{{ route('register.step1') }}">アカウント作成はこちら</a>
        </form>
    </div>
@endsection