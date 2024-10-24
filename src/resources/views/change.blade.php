@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="shop-detail-flex">
    <div class="shop-detail">
        <div class="flex">
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
    </div>
    <div class="shop-reservation">
        <h2>予約変更</h2>
        <form action="{{ route('reservation.update', ['shop_id' => $reservation->shop_id, 'reservation_id' => $reservation->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
            <div class="reservation-select">
                <input type="date" name="date" id="date" value="{{ old('date', $reservation->date) }}">
            </div>
            <div class="reservation-select">
                <select name="time" id="time" class="time">
                    <option value="" disabled selected>{{ old('time', substr($reservation->time, 0, 5)) }}</option>
                    @foreach ($timeSlots as $time)
                    <option value="{{ $time }}" {{ old('time') == $time ? 'selected' : '' }}>{{ $time }}</option>
                    @endforeach
                </select>
            </div>
            <div class="reservation-select">
                <select name="number" id="number" class="number">
                    <option value="" disabled selected>{{ old('number', $reservation->number) }}</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ old('number') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <div class="result">
                <p><span class="result-title">Shop</span><span>{{ $shop->name }}</span></p>
                <p><span class="result-title">Date</span><span id="selected-date">{{ old('date', $reservation->date) }}</span></p>
                <p><span class="result-title">Time</span><span id="selected-time">{{ old('time', substr($reservation->time, 0, 5)) }}</span></p>
                <p><span class="result-title">Number</span><span id="selected-number">{{ old('number', $reservation->number) }}</span></p>
            </div>
            <button type="submit" class="reservation-button">予約を変更する</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/detail.js') }}"></script>
@endsection