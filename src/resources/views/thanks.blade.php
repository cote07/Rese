@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-content">
    <h2>会員登録ありがとうございます</h2>
    <a href="/login" class="link">ログインする</a>
</div>
@endsection