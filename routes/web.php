<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UpdatePasswordController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['guest'])->group(function () {
    // For login-register
    Route::get('/login-register', function () {
        return view('auth.login-register');
    })->name('login-register');

    // For login
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    // For register
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    // For forgot password
    Route::get('/forgot-password', [ForgetPasswordController::class, 'showForgotForm'])->name('forgot_password');
    Route::post('/forgot-password', [ForgetPasswordController::class, 'forgot_password'])->name('forgot_password');

    // For reset password
    // Route::get('/reset-password/{token}', [ResetPasswordController::class, 'reset_password'])->name('reset_password');

    // For social login
    Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('social.login');
    Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');
});


Route::middleware(['auth'])->group(function () {
    // For home
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // For profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    // For update profile
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // For password change
    Route::post('/change-password', [ChangePasswordController::class, 'changePassword'])->name('change_password');
    // For logout
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});


// For reset password
Route::get('/reset-password/{token}/{email}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset')
    ->middleware('signed');
// For update password
Route::post('/password/update', [UpdatePasswordController::class, 'updatePassword'])
    ->name('password.update')
    ->middleware('guest');