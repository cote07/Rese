<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;

class ShopController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        $genres = Genre::all();
        $shops = Shop::with('area', 'genre')->get();
        return view('index', compact('shops', 'areas', 'genres'));
    }

    public function detail($shop_id)
    {
        $shop = Shop::with('area', 'genre')->findOrFail($shop_id);
        $user = auth()->user();

        $shopIds = Shop::orderBy('id')->pluck('id')->toArray();

        $currentIndex = array_search($shop->id, $shopIds);

        $prevIndex = $currentIndex - 1 < 0 ? count($shopIds) - 1 : $currentIndex - 1;
        $prevShopId = $shopIds[$prevIndex];

        return view('detail', compact('shop', 'user', 'prevShopId'));
    }

    public function search(Request $request)
    {
        $areaId = $request->input('area_id');
        $genreId = $request->input('genre_id');
        $keyword = $request->input('keyword');

        $shops = Shop::query()
            ->when($areaId, function ($query) use ($areaId) {
                return $query->where('area_id', $areaId);
            })
            ->when($genreId, function ($query) use ($genreId) {
                return $query->where('genre_id', $genreId);
            })
            ->when($keyword, function ($query) use ($keyword) {
                return $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->with('area', 'genre')
            ->get();

        $areas = Area::all();
        $genres = Genre::all();

        return view('index', compact('shops', 'areas', 'genres'));
    }


}
