<?php

use App\Livewire\Admin\Statistics;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Home;
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

Route::get('/', Home::class)->name('home');

// routes only for unauthenticated users
Route::prefix('auth')->middleware(['notAuth'])->as('auth.')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// admin only routes
Route::prefix('admin/dashboard')->middleware(['adminOnly'])->as('admin.')->group(function () {
    Route::get('/', Statistics::class)->name('statistics');
});