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
        <img src="{{ $shop->image_url }}" alt="{{ $shop->name }}">
        <div class="flex">
            <p>#{{ $shop->area->name }}</p>
            <p>#{{ $shop->genre->name }}</p>
        </div>
        <p>{{ $shop->description }}</p>
    </div>

    <div class="shop-reservation">
        <h2>予約</h2>
        <form action="{{ route('reservation.create', ['shop_id' => $shop->id]) }}" method="post">
            @csrf
            @if (Auth::check())
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            @endif
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <input type="date" name="date" id="date">
            <input type="time" name="time" id="time">
            <input type="number" name="number" id="number" min="1">

            <div class="result">
                <p><span class="result-title">Shop</span><span>{{ $shop->name }}</span></p>
                <p><span class="result-title">Date</span><span id="selected-date">未選択</span></p>
                <p><span class="result-title">Time</span><span id="selected-time">未選択</span></p>
                <p><span class="result-title">Number</span><span id="selected-number">未選択</span></p>
            </div>
            <button type="submit" class="reservation-button">予約する</button>
        </form>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('js/detail.js') }}"></script>
@endsection