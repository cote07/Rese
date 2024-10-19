<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Session;

class ReservationController extends Controller
{
    public function done()
    {
        return view('done');
    }

    public function create(ReservationRequest $request)
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

    public function update(Request $request, $shop_id, $reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);

        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->number = $request->number;
        $reservation->save();

        return redirect()->route('complete', ['reservation_id' => $reservation->id]);
    }

    public function change($shop_id, $reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);
        $shop = Shop::findOrFail($shop_id);
        $user = Auth::user();

        return view('change', compact('reservation','user', 'shop'));
    }

    public function complete($reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);

        return view('complete', compact('reservation'));
    }

    public function generate(Request $request)
    {
        $reservationId = $request->input('reservation_id');

        $qrCode = \QrCode::size(150)->generate($reservationId);

        Session::flash('qrCode', $qrCode);
        Session::flash('reservationId', $reservationId);

        return redirect()->back();
    }

    public function show($reservation_id)
    {
        return view('mypage', ['reservation_id' => $reservation_id]);
    }

}