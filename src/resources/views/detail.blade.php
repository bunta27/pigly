@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="container">
    <header>
        <h1 class="site-title">PiGLy</h1>
        <nav>
            <button class="button btn-model">目標体重登録設定</button>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
                <button class="button btn-logout">ログアウト</button>
            </form>
        </nav>
    </header>

    <main>
        <div class="card form-card">
            <h2>Weight Log</h2>

            <form method="POST" action="{{ route('weight_logs.update', $log->id) }}" class="form-grid">
            @csrf
            @method('PATCH')
                <label>
                    <span class="label">日付</span>
                    <input type="date" name="date" class="input" value="{{ old('date', $log->date->format('Y-m-d')) }}" required>
                    @error('date')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </label>

                <label>
                    <span class="label">体重</span>
                    <div class="input-with-suffix">
                        <input type="number" step="0.1" name="weight" class="input" value="{{ old('weight', number_format($log->weight,1)) }}" required>
                        <span>kg</span>
                    </div>
                    @error('weight')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </label>

                <label>
                    <span class="label">摂取カロリー</span>
                    <div class="input-with-suffix">
                        <input type="number" name="calories" class="input" value="{{ old('calories', $log->calories) }}" required>
                        <span>cal</span>
                    </div>
                    @error('calories')
                    <p class="error-text">{{ $message }}</p>
                    @enderror
                </label>

                <label>
                    <span class="label">運動時間</span>
                    <input type="time" name="exercise_time" class="input" value="{{ old('exercise_time', sprintf('%02d:%02d', intdiv((int)$log->exercise_time,60), (int)$log->exercise_time % 60)) }}" required>
                    @error('exercise_time')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </label>

                <label>
                    <span class="label">運動内容</span>
                    <textarea wire:model="exercise_content" class="textarea" placeholder="運動の内容を追加"></textarea>
                    @error('exercise_content')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </label>

                <div class="form-actions">
                    <a href="{{ route('admin') }}" class="button btn-secondary">戻る</a>
                    <div class="spacer"></div>

                    <form method="POST" action="{{ route('weight_logs.destroy', $log->id) }}"
                    onsubmit="return confirm('削除しますか？')">
                    @csrf
                    @method('DELETE')
                        <button class="button btn-danger" title="削除">🗑</button>
                    </form>

                    <button class="button btn-primary">更新</button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection