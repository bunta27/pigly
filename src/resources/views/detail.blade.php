@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
    <header>
        <h1 class="site-title">PiGLy</h1>
        <button class="button btn-model">目標体重登録設定</button>
        <button class="button btn-logout">ログアウト</button>
    </header>

    <main>