@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register-step2.css') }}">
@endsection

@section('body-class', 'auth-background')

@section('content')
    <div class="register-container">
        <h1 class="site-title">PiGLy</h1>
        <h2 class="container-title">新規会員登録</h2>
        <p class="step-title">STEP2 体重データの入力</p>

        <form class="form" action="{{ route('register.step2.store') }}" method="post">
            @csrf
            <div class="form-list">
                <div class="form-item">
                    <label for="weight">現在の体重</label>
                    <div class="weight-input-container">
                        <input type="text" name="weight" placeholder="現在の体重を入力">
                        <p class="weight-unit">kg</p>
                    </div>
                </div>
                @error('weight')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror

                <div class="form-item">
                    <label for="target_weight">目標の体重</label>
                    <div class="weight-input-container">
                        <input type="text" name="target_weight" placeholder="目標の体重を入力">
                        <p class="weight-unit">kg</p>
                    </div>
                </div>
                @error('target_weight')
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