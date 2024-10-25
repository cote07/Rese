@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner.css') }}">
@endsection

@section('content')
<h2 class="myshop">MyShop</h2>
<div class="shop-container">
    <div class="shop-content" id="search-results">
        @foreach($shops as $shop)
        <div class="shop-list">
            @if (Str::startsWith($shop->image_url, 'http'))
            <img src="{{ $shop->image_url }}" alt="{{ $shop->name }}">
            @else
            <img src="{{ asset('storage/' . $shop->image_url) }}" alt="Shop Image">
            @endif
            <div class="shop-list-text">
                <div class="shop">
                    <h3>{{ $shop->name }}</h3>
                    <div class="flex">
                        <p>#{{ $shop->area->name }}</p>
                        <p>#{{ $shop->genre->name }}</p>
                    </div>
                </div>
                <div class="link-flex">
                    <a href="{{ route('owner.reservations', ['shop_id' => $shop->id]) }}" class="look-link">予約情報</a>
                    <a href="{{ route('owner.shop.edit', ['shop_id' => $shop->id]) }}" class="look-link">店舗情報変更</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <a href="{{ route('shop.create') }}" class="add-button">+</a>
</div>
@endsection