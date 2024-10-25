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
        $reservation->date = $request->input('date') ?? $reservation->date;
        $reservation->time = $request->input('time') ?? $reservation->time;
        $reservation->number = $request->input('number') ?? $reservation->number;
        $reservation->save();

        return redirect()->route('complete', ['reservation_id' => $reservation->id]);
    }

    public function change($shop_id, $reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);
        $shop = Shop::findOrFail($shop_id);
        $user = Auth::user();

        $timeSlots = [];
        $start = strtotime('09:00');
        $end = strtotime('21:00');

        while ($start <= $end) {
            $timeSlots[] = date('H:i', $start);
            $start = strtotime('+30 minutes', $start);
        }

        return view('change', compact('reservation', 'user', 'shop', 'timeSlots'));
    }

    public function complete($reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);

        return view('complete', compact('reservation'));
    }

    public function generate(Request $request)
    {
        $reservationId = $request->input('reservation_id');
        $reservation = Reservation::with(['shop', 'user'])->find($reservationId);
        $qrData = sprintf(
            "Date: %s\nTime: %s\nNumber: %d\nShop: %s\nUser: %s\nEmail: %s",
            $reservation->shop->name,
            $reservation->user->name,
            $reservation->user->email,
            $reservation->date,
            $reservation->time,
            $reservation->number,
        );

        $qrCode = \QrCode::encoding('UTF-8')->size(150)->generate($qrData);
        Session::flash('qrCode', $qrCode);
        Session::flash('reservationId', $reservationId);

        return redirect()->back();
    }

    public function show($reservation_id)
    {
        return view('mypage', ['reservation_id' => $reservation_id]);
    }
}