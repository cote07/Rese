<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function review(Request $request)
    {
        $shop_id = $request->query('shop_id');
        $shop = Shop::with('reviews')->findOrFail($shop_id);
        $reservation_id = $request->query('reservation_id');
        $user_id = auth()->check() ? auth()->id() : null;

        return view('review', compact('shop', 'reservation_id','shop_id', 'user_id'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $shopId = $request->input('shop_id');

        $reservationExists = Reservation::where('user_id', $userId)
            ->where('shop_id', $shopId)
            ->exists();

        if (!$reservationExists) {
            return redirect()->back()->withErrors(['reservation' => 'レビューを行うには、事前に予約が必要です。']);
        }

        $existingReview = Review::where('user_id', $userId)
            ->where('shop_id', $shopId)
            ->first();

        if ($existingReview) {
            return redirect()->back()->withErrors(['review' => 'この店舗は評価はすでに行われています。']);
        }

        Review::create([
            'user_id' => auth()->id(),
            'shop_id' => $request->input('shop_id'),
            'reservation_id' => $request->input('reservation_id'),
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('detail', ['shop_id' => $request->input('shop_id')]);
    }
}
