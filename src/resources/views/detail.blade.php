@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="shop-detail-flex">
    <div class="shop-detail">
        <div class="flex">
            <a href="{{ route('detail', ['shop_id' => $prevShopId]) }}" class="prev-button">
                <</a>
                    <h2>{{ $shop->name }}</h2>
        </div>
        @if (Str::startsWith($shop->image_url, 'http'))
        <img src="{{ $shop->image_url }}" alt="{{ $shop->name }}">
        @else
        <img src="{{ asset('storage/' . $shop->image_url) }}" alt="Shop Image">
        @endif
        <div class="flex">
            <p>#{{ $shop->area->name }}</p>
            <p>#{{ $shop->genre->name }}</p>
        </div>
        <p>{{ $shop->description }}</p>
        <div class="review-content">
            <div class="review-flex">
                <h2>レビュー</h2>
                @if (Auth::check())
                <a href="{{ route('reviews', ['shop_id' => $shop->id, 'reservation_id' => $reservation_id]) }}" class="review-button">投稿する</a>
                @endif
            </div>
            @if ($shop->reviews->isEmpty())
            <p>まだレビューはありません。</p>
            @else
            @foreach ($shop->reviews as $review)
            <div class="review-text">
                <p>評価 {{ $review->rating }}</p>
                <p>コメント</p>
                <p>{{ $review->comment }}</p>
                <p>投稿日時 {{ $review->created_at->format('Y-m-d H:i') }}</p>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <div class="shop-reservation">
        <h2>予約</h2>
        <form action="{{ route('reservation.create', ['shop_id' => $shop->id]) }}" method="post">
            @csrf
            @if (Auth::check())
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            @endif
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <div class="reservation-select">
                <input type="date" name="date" id="date" value="{{ old('date') }}">
                <div class="reservation__error">
                    @error('date')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="reservation-select">
                <select name="time" id="time" class="time">
                    <option value="" disabled selected>時間</option>
                    @foreach ($timeSlots as $time)
                    <option value="{{ $time }}" {{ old('time') == $time ? 'selected' : '' }}>{{ $time }}</option>
                    @endforeach
                </select>
                <div class="reservation__error">
                    @error('time')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="reservation-select">
                <select name="number" id="number" class="number">
                    <option value="" disabled selected>人数</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ old('number') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                </select>
                <div class="reservation__error">
                    @error('number')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="result">
                <p><span class="result-title">Shop</span><span>{{ $shop->name }}</span></p>
                <p><span class="result-title">Date</span><span id="selected-date">{{ old('date') ? old('date') : '未選択' }}</span></p>
                <p><span class="result-title">Time</span><span id="selected-time">{{ old('time') ? old('time') : '未選択' }}</span></p>
                <p><span class="result-title">Number</span><span id="selected-number">{{ old('number') ? old('number') . '人' : '未選択' }}</span></p>
            </div>
            <button type="submit" class="reservation-button">予約する</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/detail.js') }}"></script>
@endsection