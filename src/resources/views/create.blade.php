@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<h2>新店舗を作成</h2>
<form action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="name">店舗名</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="form-group">
        <label for="area_id">エリア</label>
        <select name="area_id" class="form-control">
            <option value="" selected disabled>エリアを選択してください</option>
            @foreach ($areas as $area)
            <option value="{{ $area->id }}">{{ $area->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="genre_id">ジャンル</label>
        <select name="genre_id" class="form-control">
            <option value="" selected disabled>ジャンルを選択してください</option>
            @foreach ($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="description">説明</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="image_url">画像</label>
        <input type="file" name="image_url" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">作成</button>
</form>
@endsection