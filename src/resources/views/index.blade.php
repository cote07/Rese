@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="search-content">
    <form id="search-form" method="GET" action="{{ route('search') }}">
        <select id="area-select" name="area_id" onchange="document.getElementById('search-form').submit();">
            <option value="">All area</option>
            @foreach ($areas as $area)
            <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
            @endforeach
        </select>

        <select id="genre-select" name="genre_id" onchange="document.getElementById('search-form').submit();">
            <option value="">All genre</option>
            @foreach ($genres as $genre)
            <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
            @endforeach
        </select>

        <div class="search-text">
            <span class="material-icons-outlined search-icon">
                search
            </span>
            <input type="text" name="keyword" placeholder="Search..." value="{{ request('keyword') }}" class="keyword" id="keyword-input">
        </div>
    </form>
</div>

<div class=" shop-container">
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
                    <h2>{{ $shop->name }}</h2>
                    <div class="flex">
                        <p>#{{ $shop->area->name }}</p>
                        <p>#{{ $shop->genre->name }}</p>
                    </div>
                </div>
                <div class="favorites-flex">
                    <a href="/detail/{{ $shop->id }}" class="look-link">詳しくみる</a>
                    @if (Auth::check())
                    @php
                    $isFavorite = auth()->user()->favorites->contains('shop_id', $shop->id);
                    @endphp

                    @if ($isFavorite)
                    {{-- お気に入りの削除フォーム --}}
                    <form action="{{ route('favorite.delete', ['shop_id' => $shop->id]) }}" method="POST" class="shop__button-favorite form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="shop__button-favorite-btn">
                            <span class="material-icons-outlined favorite-icon active">
                                favorite
                            </span>
                        </button>
                    </form>
                    @else
                    {{-- お気に入りの追加フォーム --}}
                    <form action="{{ route('favorite.create', ['shop_id' => $shop->id]) }}" method="POST" class="shop__button-favorite form">
                        @csrf
                        <button type="submit" class="shop__button-favorite-btn">
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

@endsection