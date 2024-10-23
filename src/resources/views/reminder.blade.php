<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Reminder</title>
</head>

<body>
    <p>{{ $user->name }} 様</p>
    <p>本日ご予約日となっております</p>
    <p><strong>ご予約の内容:</strong></p>
    <div>
        <ul>
            <li>店名: {{ $shop->name }}</li>
            <li>日付: {{ $reservation->date }}</li>
            <li>時間: {{ substr($reservation->time, 0, 5) }}</li>
            <li>人数: {{ $reservation->number }}</li>
        </ul>
    </div>
    <p>ご来店お待ちしております</p>
</body>

</html>