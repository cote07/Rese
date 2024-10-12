<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shops()
    {
        return $this->belongsTo(Shop::class);
    }

    public function reservations()
    {
        return $this->belongsTo(Reservation::class);
    }

    protected $fillable = [
        'user_id',
        'shop_id',
        'reservation_id',
        'rating',
        'comment',
    ];
}
