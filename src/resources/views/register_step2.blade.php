@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="register-container">
        <h1 class="site-title">PiGLy</h1>
        <h2 class="container-title">新規会員登録</h2>
        <p class="step-title">STEP2 体重データの入力</p>

        <form class="form" action="/register/step2" method="post">
            @csrf
            <div class="form-list">
                <div class="form-item">
                    <label for="weight">現在の体重</label>
                    <input type="number" name="weight" placeholder="現在の体重を入力">
                    <p>kg</p>
                </div>
                @error('name')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror

                <div class="form-item">
                    <label for="weight">目標の体重</label>
                    <input type="number" name="weight" placeholder="目標の体重を入力">
                    <p>kg</p>
                </div>
                @error('email')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="button-container">
                <button type="submit" class="button btn-register">アカウント作成
                </button>
            </div>
        </form>
    </div>
@endsection