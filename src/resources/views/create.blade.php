@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<h2>新店舗を作成</h2>
<form action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label>店舗名</label>
        <input type="text" name="name" class="form-control">
        <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>エリア</label>
        <select name="area_id" class="form-control">
            <option value="" selected disabled>エリアを選択してください</option>
            @foreach ($areas as $area)
            <option value="{{ $area->id }}">{{ $area->name }}</option>
            @endforeach
        </select>
        <div class="form__error">
            @error('area_id')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>ジャンル</label>
        <select name="genre_id" class="form-control">
            <option value="" selected disabled>ジャンルを選択してください</option>
            @foreach ($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
        </select>
        <div class="form__error">
            @error('genre_id')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>説明</label>
        <textarea name="description" class="form-control"></textarea>
        <div class="form__error">
            @error('description')
            {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label>画像</label>
        <input type="file" name="image_url" class="form-control" accept="image/*">
        <div class="form__error">
            @error('image_url')
            {{ $message }}
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">作成</button>
</form>
@endsection