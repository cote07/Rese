<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ChargeController;
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

Route::group(['middleware' => ['role:admin']], function () {
  Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
  Route::post('/admin/create', [AdminController::class, 'create'])->name('admin.create');
});

Route::group(['middleware' => ['role:owner']], function () {
  Route::get('/owner', [OwnerController::class, 'owner'])->name('owner');
  Route::get('/owner/reservations', [OwnerController::class, 'confirmation'])->name('owner.reservations');
  Route::post('/owner/update', [OwnerController::class, 'update'])->name('owner.update');
  Route::get('/mail', [MailController::class, 'mail'])->name('mail');
  Route::post('/mail/send', [MailController::class, 'send'])->name('mail.send');
});

Route::middleware(['auth', 'role:user'])->group(function () {
  Route::get('/done', [ReservationController::class, 'done'])->name('done');
  Route::get('/thanks', [RegisterController::class, 'thanks'])->name('thanks');
  Route::post('/shops/{shop_id}/favorites', [FavoriteController::class, 'create'])->name('favorite.create');
  Route::delete('/shops/{shop_id}/favorites', [FavoriteController::class, 'delete'])->name('favorite.delete');
  Route::post('/shops/{shop_id}/reservations', [ReservationController::class, 'create'])->name('reservation.create');
  Route::delete('/shops/{shop_id}/reservations/{reservation_id}', [ReservationController::class, 'delete'])->name('reservation.delete');
  Route::patch('/shops/{shop_id}/reservations/{reservation_id}', [ReservationController::class, 'update'])->name('reservation.update');
  Route::get('/shops/{shop_id}/reservations/{reservation_id}', [ReservationController::class, 'change'])->name('change');
  Route::get('/complete/{reservation_id}', [ReservationController::class, 'complete'])->name('complete');
  Route::get('/mypage', [UserController::class, 'mypage']);
  Route::get('/reviews', [ReviewController::class, 'review'])->name('reviews');
  Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
  Route::post('/qrcode', [ReservationController::class, 'generate'])->name('qrcode');
  Route::get('/qrcode/{reservation_id}', [ReservationController::class, 'show'])->name('qrcode.show');
  Route::post('/charge', [ChargeController::class, 'charge'])->name('charge');
});

Route::post('/login', [AuthController::class, 'store']);
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/', [ShopController::class, 'index'])->name('index');
Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->name('detail');
Route::get('/search', [ShopController::class, 'search'])->name('search');
