@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="container">
    <header>
        <h1 class="site-logo">PiGLy</h1>
        <button class="button btn-model">目標体重登録設定</button>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
        @csrf
            <button class="button btn-logout">ログアウト</button>
        </form>
    </header>

    <main>
        <div class="card status status--group">
            <div class="status-item">
                <div class="status-label">目標体重</div>
                <div class="status-value">
                    <span class="status-number">{{ number_format($target->target_weight,1) }}</span><span class="status-unit">kg</span>
                </div>
            </div>
            <div class="status-item">
                <div class="status-label">目標まで</div>
                <div class="status-value">
                    <span class="status-number">{{ $toGoal !== null ? number_format($toGoal,1) : '-' }}</span><span class="status-unit">kg</span>
                </div>
            </div>
            <div class="status-item">
                <div class="status-label">最新体重</div>
                <div class="status-value">
                    <span class="status-number">{{ $latestWeight !== null ? number_format($latestWeight,1) : '-' }}</span><span class="status-unit">kg</span>
                </div>
            </div>
        </div>


        <div class="toolbar">
            <form method="get" class="filter">
                <input type="date" name="from" value="{{ request('from') }}" class="input-date">
                <span class="tilde">～</span>
                <input type="date" name="to" value="{{ request('to') }}" class="input-date">
                <button type="submit" class="button btn-filter">検索</button>
                <a href="{{ route('admin') }}" class="button btn-reset">リセット</a>
            </form>
            <button id="openModal" class="button btn-primary">データ追加</button>
        </div>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>日付</th>
                        <th>体重</th>
                        <th>食事摂取カロリー</th>
                        <th>運動時間</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr>
                            <td>{{ $log->date->format('Y/m/d') }}</td>
                            <td>{{ number_format($log->weight,1) }} kg</td>
                            <td>{{ number_format($log->calories) }} cal</td>
                            <td>{{ sprintf('%02d:%02d', intdiv($log->exercise_time,60), $log->exercise_time % 60) }}</td>
                            <td>
                                <a href="{{ route('weight_logs.show', $log->id) }}" class="button btn-edit">
                                    <img src="{{ asset('icons/pen.svg') }}" class="icon">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $logs->links() }}
            </div>
        </div>
    </main>
</div>


@endsection