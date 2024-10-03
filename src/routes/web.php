<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 Route::middleware('auth')->group(function () {
    Route::get('/done', [ReservationController::class, 'done'])->name('done');
    Route::get('/thanks', [RegisterController::class, 'thanks'])->name('thanks');
    Route::post('/shops/{shop_id}/favorites', [FavoriteController::class, 'create'])->name('favorite.create');
    Route::delete('/shops/{shop_id}/favorites', [FavoriteController::class, 'delete'])->name('favorite.delete');
    Route::post('/shops/{shop_id}/reservations', [ReservationController::class, 'create'])->name('reservation.create');
    Route::delete('/shops/{shop_id}/reservations/{reservation_id}', [ReservationController::class, 'delete'])->name('reservation.delete');
    Route::get('/mypage', [UserController::class, 'mypage']);
 });

Route::post('/login', [AuthController::class, 'store']);
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/', [ShopController::class, 'index'])->name('index');
Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->name('detail');
Route::get('/search', [ShopController::class, 'search'])->name('search');



