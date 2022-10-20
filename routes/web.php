<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminSchedulesController;
use App\Http\Controllers\Admin\AdminScheduleServiceController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\WebpageController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/', [WebpageController::class, 'welcome'])->name('home');
Route::post('/user/book', [BookingController::class, 'save'])->name('save');
Route::get('/contact-us', [WebpageController::class, 'contactUs'])->name('contact');
Route::get('/product/{id}', [ProductsController::class, 'show'])->name('product');

Route::get('/profile', [WebpageController::class, 'profile'])->name('profile');

Route::get('/schedules', [SchedulesController::class, 'list'])->name('schedules');
Route::get('/book', [BookingController::class, 'form'])->name('form');

Route::get('/history', [HistoryController::class, 'list'])->name('history');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('/users', UserController::class);
    Route::resource('/bookings', BookController::class);
    Route::resource('/schedules', AdminSchedulesController::class);
    Route::resource('/scheduleservices', AdminScheduleServiceController::class);
});

Route::any('/book/return/{booking}', [BookingController::class, 'paymentReturn'])->name('book.return');
Route::any('/book/cancel/{booking}', [BookingController::class, 'paymentCancel'])->name('book.cancel');
Route::any('/book/success/{booking}', [BookingController::class, 'success'])->name('book.success');
Route::any('/book/failed/{booking}', [BookingController::class, 'failed'])->name('book.failed');

Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google-auth');

Route::get('/auth/callback', [GoogleController::class, 'calllbackGoogle']);

Route::get('/auth/facebook/redirect', function () {
    return Socialite::driver('facebook')->redirect();
})->name('facebook-auth');

Route::get('/auth/facebook/callback', [FacebookController::class, 'calllbackFacebook']);

Route::get('/auth/github/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('github-auth');

Route::get('/auth/github/callback', function () {
    $githubUser = Socialite::driver('github')->user();

    $user = User::where('email', $githubUser->email)->first();

    if (!$user) {
        $new_user = User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_id' => $githubUser->id,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,

        ]);

        Auth::login($new_user);

        return redirect()->intended('/');
    } else {
        Auth::login($user);

        return redirect()->intended('/');
    }
});

/*  multiple route that need to use authenticate
Route::middleware(['auth'])->group(function(){

});
 */

require __DIR__ . '/auth.php';
