@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
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
    <div class="edit-content">
        <h2>店舗情報の変更</h2>
        <form action="{{ route('owner.shop.update', ['shop_id' => $shop->id]) }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label class="form-label">店舗名</label>
                <input type="text" name="name" class="form-control" value="{{ $shop->name }}">
            </div>
            <div class="form-group">
                <label class="form-label">エリア</label>
                <select name="area_id" class="form-control">
                    @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ $shop->area_id == $area->id ? 'selected' : '' }}>
                        {{ $area->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">ジャンル</label>
                <select name="genre_id" class="form-control">
                    @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $shop->genre_id == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">説明</label>
                <textarea name="description">{{ $shop->description }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">画像</label>
                <input type="file" name="image_url" accept="image/*">
            </div>
            <button type="submit" class="update-button">更新する</button>
        </form>
    </div>
</div>
@endsection