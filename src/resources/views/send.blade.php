@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/send.css') }}">
@endsection

@section('content')
<div class="email-content">
    <div class="email-title">
        <h2>Email</h2>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('mail.send') }}" method="POST" class="form">
        @csrf
        <div class="form-group">
            <label>宛名</label>
            <select name="recipient_id" class="mail-recipient">
                <option value="">宛先を選択</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>件名</label>
            <input type="text" name="subject" class="mail-subject" value="{{ old('subject') }}">
        </div>

        <div class="form-group">
            <label>本文</label>
            <textarea name="message" class="mail-message">{{ old('message') }}</textarea>
        </div>

        <div class="form-group-button">
            <button type="submit" class="send-button">送信</button>
        </div>
    </form>
</div>
@endsection