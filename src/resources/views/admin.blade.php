@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
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
                @if(request('from') || request('to'))
                    <a href="{{ route('admin') }}" class="button btn-reset">リセット</a>
                @endif
            </form>
            <button class="button btn-primary" onclick="Livewire.emit('openModal')">データ追加</button>
        </div>

        @if(request()->filled('from') && request()->filled('to'))
            <p class="search-result">
                {{ (new DateTime(request('from')))->format('Y年m月d日') }}～{{ (new DateTime(request('to')))->format('Y年m月d日') }}の検索結果　{{ $logs->total() }}件
            </p>
        @endif

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
                            <td>{{ $log->exercise_time }}</td>
                            <td>
                                <a href="{{ route('weight_logs.show', $log->id) }}" class="button btn-edit">
                                    @include('icons.pen')
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $logs->links('vendor.pagination.pigly') }}
            </div>
        </div>
        <livewire:modal />
    </main>
</div>

@endsection