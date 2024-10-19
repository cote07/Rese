<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Shop extends Model
{
    use HasFactory;

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'owners', 'shop_id', 'user_id');
    }

    protected $fillable = [
        'name',
        'area_id',
        'genre_id',
        'description',
        'image_url',
    ];

}
