@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done-content">
    <h2>予約の変更が完了しました</h2>
    <a href="/" class="link">戻る</a>
</div>
@endsection