<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function done()
    {
        return view('done');
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        $reservationData = $request->only(['date', 'time', 'number']);

        $reservationData['user_id'] = $request->input('user_id');
        $reservationData['shop_id'] = $request->input('shop_id');

        Reservation::create($reservationData);

        return redirect()->route('done')->with('user', $user);
    }

    public function delete($shop_id, $reservation_id)
    {
        $reservation = Reservation::where('id', $reservation_id)->where('shop_id', $shop_id)->firstOrFail();
        $reservation->delete();

        return back();
    }

}
