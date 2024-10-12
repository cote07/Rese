@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>レビューを投稿する</h2>
    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="reservation_id" value="{{ $reservation_id }}">
        <input type="hidden" name="shop_id" value="{{ $shop_id }}">
        <input type="hidden" name="user_id" value="{{ $user_id }}">

        <div class="form-group">
            <label for="rating">評価:</label>
            <select name="rating" id="rating" required>
                <option value="">選択してください</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="comment">コメント:</label>
            <textarea name="comment" id="comment"></textarea>
        </div>

        @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
        @endif

        <button type="submit" class="btn btn-primary">投稿</button>
    </form>
</div>
@endsection