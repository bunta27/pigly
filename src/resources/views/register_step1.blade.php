@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="register-container">
        <h1 class="site-title">PiGLy</h1>
        <h2 class="container-title">新規会員登録</h2>
        <p class="step-title">STEP1 アカウント情報の登録</p>

        <form class="form" action="/register/step1" method="post">
            @csrf
            <div class="form-list">
                <div class="form-item">
                    <label for="name">お名前</label>
                    <input type="text" name="name" placeholder="名前を入力">
                </div>
                @error('name')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror

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
                <button type="submit" class="next-button">次に進む
                </button>
            </div>

            <a href="/login">ログインはこちら</a>
        </form>
    </div>
@endsection