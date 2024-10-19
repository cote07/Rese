<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Area;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function owner()
    {
        $user = Auth::user();

        $shops = $user->ownedShops;

        return view('owner', compact('shops'));
    }

    public function reservations($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);

        $reservations = Reservation::where('shop_id', $shop->id)->get();

        return view('reservation', compact('shop', 'reservations'));
    }

    public function edit($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);
        $areas = Area::all();
        $genres = Genre::all();

        return view('edit', compact('shop', 'areas', 'genres'));
    }

    public function update(Request $request, $shop_id)
    {
        $shop = Shop::findOrFail($shop_id);

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('images', 'public');
            $shop->image_url = $path;
        }

        $shop->name = $request->name;
        $shop->area_id = $request->area_id;
        $shop->genre_id = $request->genre_id;
        $shop->description = $request->description;

        $shop->save();

        $areas = Area::all();
        $genres = Genre::all();

        return view('edit', compact('shop', 'areas', 'genres'));
    }

    public function create()
    {
        $areas = Area::all();
        $genres = Genre::all();

        return view('create', compact('areas', 'genres'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('images', 'public');
        }

        $shop = Shop::create([
            'name' => $request->name,
            'description' => $request->description,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'image_url' => $path,
        ]);

        $user = Auth::user();
        $user->ownedShops()->attach($shop->id);

        return redirect()->route('owner');
    }
}