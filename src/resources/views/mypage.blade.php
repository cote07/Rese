@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')

<div class="mypage-content">
    <h2 class="mypage-name">{{ $user->name }}さん</h2>
    <div class="flex">
        <div class="reservations-section">
            <h3>予約状況</h3>
            @foreach($reservations as $reservation)
            <div class="reservation">
                <div class="reservation-flex">
                    <div class="reservationーcount">
                        <span class="material-icons-outlined">
                            schedule
                        </span>
                        <p>予約{{ $loop->iteration }}</p>
                    </div>
                    <form action="{{ route('reservation.delete', ['shop_id' => $reservation->shop_id, 'reservation_id' => $reservation->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="close-button">
                            <span class="material-icons-outlined close-icon">
                                close
                            </span>
                        </button>
                    </form>
                </div>
                <p><span class="result-title">Shop</span><span>{{ $reservation->shop->name }}</span></p>
                <p><span class="result-title">Date</span><span>{{ $reservation->date }}</span></p>
                <p><span class="result-title">Time</span><span>{{ $reservation->time }}</span></p>
                <p><span class="result-title">Number</span><span>{{ $reservation->number }}</span></p>
            </div>
            @endforeach
        </div>
        <div class="favorites-section">
            <h3>お気に入り店舗</h3>
            <div class="favorites-section-flex">
                @foreach($favorites as $favorite)
                <div class="shop-list">
                    <img src="{{ $favorite->shop->image_url }}" alt="{{ $favorite->shop->name }}">
                    <div class="shop-list-text">
                        <div class="shop">
                            <h2>{{ $favorite->shop->name }}</h2>
                            <div class="flex">
                                <p>#{{ $favorite->shop->area->name }}</p>
                                <p>#{{ $favorite->shop->genre->name }}</p>
                            </div>
                        </div>
                        <div class="favorites-flex">
                            <a href="/detail/{{ $favorite->shop->id }}" class="look-link">詳しくみる</a>
                            @if (Auth::check())
                            @php
                            $isFavorite = auth()->user()->favorites->contains('shop_id', $favorite->shop->id);
                            @endphp

                            @if ($isFavorite)
                            {{-- お気に入りの削除フォーム --}}
                            <form action="{{ route('favorite.delete', ['shop_id' => $favorite->shop->id]) }}" method="POST" class="shop__button-favorite form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="shop__button-favorite-btn" title="お気に入り削除">
                                    <span class="material-icons-outlined favorite-icon active">
                                        favorite
                                    </span>
                                </button>
                            </form>
                            @else
                            {{-- お気に入りの追加フォーム --}}
                            <form action="{{ route('favorite.create', ['shop_id' => $favorite->shop->id]) }}" method="POST" class="shop__button-favorite form">
                                @csrf
                                <button type="submit" class="shop__button-favorite-btn" title="お気に入り追加">
                                    <span class="material-icons-outlined favorite-icon">
                                        favorite
                                    </span>
                                </button>
                            </form>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection