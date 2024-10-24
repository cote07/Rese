@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="create-content">
    <h2>新店舗作成</h2>
    <form action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf
        <div class="form-group">
            <div class="flex">
                <label class="form-label">店舗名</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="flex">
                <label class="form-label">エリア</label>
                <select name="area_id" class="form-control">
                    <option value="" selected disabled>エリアを選択してください</option>
                    @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
                @error('area_id')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="flex">
                <label class="form-label">ジャンル</label>
                <select name="genre_id" class="form-control">
                    <option value="" selected disabled>ジャンルを選択してください</option>
                    @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
                @error('genre_id')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="flex">
                <label class="form-label">説明</label>
                <textarea name="description" class="form-control" rows="6"></textarea>
            </div>
            <div class="form__error">
                @error('description')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="flex">
                <label class="form-label">画像</label>
                <input type="file" name="image_url" accept="image/*">
            </div>
            <div class="form__error">
                @error('image_url')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="create-btn">
            <button type="submit" class="create-button">作成</button>
        </div>
    </form>
</div>
@endsection