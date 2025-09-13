@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/model.css') }}">
@endsection

@section('content')
<div class="container">
    <header class="header">
        <h1 class="site-logo">PiGLy</h1>
        <div class="header-button">
            <a href="{{ route('target.edit') }}" class="button btn-model">
                <span><img src="/icons/gear.svg" class="icon"></span>
                目標体重設定
            </a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
                <button class="button btn-logout">
                    <span>
                        <img src="/icons/logout.svg" class="icon">
                    </span>
                    ログアウト
                </button>
            </form>
        </div>
    </header>

    <main class="main">
        <div class="card form-card">
            <h2>目標体重設定</h2>

            <form method="POST" action="{{ route('target.update') }}" novalidate>
            @csrf
            @method('PATCH')
                <label>
                    <div class="input-with-suffix">
                        <input type="text" name="target_weight" value="{{ old('target_weight', $target->target_weight) }}" class="input" required>
                        <span>kg</span>
                    </div>
                    @error('target_weight')
                        <p class="error-text">
                            {{ $message }}
                        </p>
                    @enderror
                </label>

                <div class="form-actions">
                    <a href="{{ route('admin') }}" class="button btn-secondary">戻る</a>
                    <a  href="{{ route('admin') }}" class="button btn-primary">保存</a>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection