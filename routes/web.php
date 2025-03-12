<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\WeatherController;
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

Route::get('/weather/{city}', [WeatherController::class, 'getWeather'])->name('getWeather');
Route::get('/weather', function () {
    return view('weather');
})->name('weather');

Route::get('/send-email', [MailController::class, 'showMailForm'])->name('send-email-form');
Route::post('/send-email', [MailController::class, 'sendEmail'])->name('send-email');



Route::get('/sms', [SmsController::class, 'showSMSForm'])->name('sms.form');
Route::post('/send-sms', [SmsController::class, 'sendSms'])->name('send-sms');  // ✅ ROUTE TO‘G‘RI


Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'register_store'])->name('register.store');
Route::get('seller', [AuthController::class, 'seller'])->name('seller');
Route::post('seller', [AuthController::class, 'seller_store'])->name('seller.store');

// Route::get('/posts/{date}/{slug}', [PostController::class, 'show'])->name('posts.show');
// Route::resource('/posts', PostController::class);

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');         // Barcha postlarni ko'rsatish
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');   // Post yaratish formasi
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');           // Yangi postni saqlash
Route::get('/posts/{date}/{slug}', [PostController::class, 'show'])->name('posts.show');  // Bitta postni ko'rsatish
Route::get('/posts/{date}/{slug}/edit', [PostController::class, 'edit'])->name('posts.edit');  // Postni tahrirlash formasi
Route::put('/posts/{date}/{slug}', [PostController::class, 'update'])->name('posts.update');  // Postni yangilash
Route::delete('/posts/{date}/{slug}', [PostController::class, 'destroy'])->name('posts.destroy');  // Postni o'chirish


Route::get('search', [SearchController::class, 'search'])->name('search');
