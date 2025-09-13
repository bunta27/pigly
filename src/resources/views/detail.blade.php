@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
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
            <h2>Weight Log</h2>

            <form id="updateForm" method="POST" action="{{ route('weight_logs.update', ['weightLogId' => $log->id]) }}" class="form-grid">
            @csrf
            @method('PATCH')
                <label>
                    <span class="label">日付</span>
                    <input type="date" name="date" class="input" value="{{ old('date', $log->date->format('Y年m月d日')) }}">
                    @error('date')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </label>

                <label>
                    <span class="label">体重</span>
                    <div class="input-with-suffix">
                        <input type="text" name="weight" class="input input-weight" value="{{ old('weight', number_format($log->weight,1)) }}">
                        <span>kg</span>
                    </div>
                    @error('weight')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </label>

                <label>
                    <span class="label">摂取カロリー</span>
                    <div class="input-with-suffix">
                        <input type="number" name="calories" class="input input-calories" value="{{ old('calories', $log->calories) }}">
                        <span>cal</span>
                    </div>
                    @error('calories')
                    <p class="error-text">{{ $message }}</p>
                    @enderror
                </label>

                <label>
                    <span class="label">運動時間</span>
                    <input type="time" name="exercise_time" class="input" value="{{ old('exercise_time', sprintf('%02d:%02d', intdiv((int)$log->exercise_time,60), (int)$log->exercise_time % 60)) }}">
                    @error('exercise_time')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </label>

                <label>
                    <span class="label">運動内容</span>
                    <textarea name="exercise_content" class="textarea" placeholder="運動の内容を追加"></textarea>
                    @error('exercise_content')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>
            </form>

            <div class="actions-row">
                <div class="actions-left">
                    <a href="{{ route('admin') }}" class="button btn-secondary">戻る</a>
                    <button type="submit" form="updateForm" class="button btn-primary">更新</button>
                </div>

                <form method="POST" action="{{ route('weight_logs.destroy', $log->id) }}" onsubmit="return confirm('削除しますか？')">
                    @csrf
                    @method('DELETE')
                        <button class="button btn-danger" title="削除">🗑</button>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection