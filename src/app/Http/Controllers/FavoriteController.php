<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function create($shop_id)
    {
        $user = Auth::user();
        $exists = Favorite::where('user_id', $user->id)
            ->where('shop_id', $shop_id)
            ->exists();

        if (!$exists) {
            Favorite::create([
                'user_id' => $user->id,
                'shop_id' => $shop_id,
            ]);
        }
        return back();
    }

    public function delete($shop_id)
    {
        $user = Auth::user();

        Favorite::where('user_id', $user->id)
            ->where('shop_id', $shop_id)
            ->delete();
        return back();
    }
}