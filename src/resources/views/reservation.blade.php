@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
@endsection

@section('content')
<div class="reservation-container">
    <h2>{{ $shop->name }}の予約情報</h2>

    @if($reservations->isEmpty())
    <p>予約がまだありません。</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>日付</th>
                <th>時間</th>
                <th>人数</th>
                <th>名前</th>
                <th>メールアドレス</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
            <tr>
                <td>{{ $reservation->date }}</td>
                <td>{{ substr($reservation->time, 0, 5) }}</td>
                <td>{{ $reservation->number }}</td>
                <td>{{ $reservation->user->name }}</td>
                <td>{{ $reservation->user->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    {{ $reservations->links('vendor.pagination.custom') }}
</div>
@endsection