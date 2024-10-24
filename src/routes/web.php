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
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\VerificationController;

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

Route::group(['middleware' => ['auth', 'role:admin']], function () {
  Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
  Route::post('/admin/create', [AdminController::class, 'create'])->name('admin.create');
});

Route::group(['middleware' => ['auth', 'role:owner']], function () {
  Route::get('/owner', [OwnerController::class, 'owner'])->name('owner');
  Route::get('/owner/{shop_id}/reservations', [OwnerController::class, 'reservations'])->name('owner.reservations');
  Route::get('/mail', [MailController::class, 'mail'])->name('mail');
  Route::post('/mail/send', [MailController::class, 'send'])->name('mail.send');
  Route::get('/shop/create', [OwnerController::class, 'create'])->name('shop.create');
  Route::post('/shop/store', [OwnerController::class, 'store'])->name('shop.store');
  Route::patch('/owner/{shop_id}', [OwnerController::class, 'update'])->name('owner.shop.update');
  Route::get('/owner/{shop_id}/edit', [OwnerController::class, 'edit'])->name('owner.shop.edit');
});

Route::middleware(['auth', 'role:user'])->group(function () {
  Route::get('/done', [ReservationController::class, 'done'])->name('done');
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
Route::get('/thanks', [RegisterController::class, 'thanks'])->name('thanks');
Route::get('/', [ShopController::class, 'index'])->name('index');
Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->name('detail');
Route::get('/search', [ShopController::class, 'search'])->name('search');

Route::get('/email/verify', function () {
  return view('verify');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();
  return redirect('/thanks');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/resend-verification-email', [VerificationController::class, 'resend'])
  ->middleware(['auth', 'throttle:6,1'])
  ->name('verification.resend');