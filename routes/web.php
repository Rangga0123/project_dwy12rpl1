<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RestockRequestController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Semua Route yang Membutuhkan Login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Buku
    |--------------------------------------------------------------------------
    */

    Route::resource('books', BookController::class);

    /*
    |--------------------------------------------------------------------------
    | Kategori Buku
    |--------------------------------------------------------------------------
    */

    Route::resource('categories', CategoryController::class)->except(['show', 'edit', 'update']);

    /*
    |--------------------------------------------------------------------------
    | Restock dari Buku
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/books/{id}/restock',
        [BookController::class, 'processRestock']
    )->name('books.restock');


    /*
    |--------------------------------------------------------------------------
    | Pengajuan Restock User
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/pengajuan-restock',
        [RestockRequestController::class, 'create']
    )->name('user.restock.create');

    Route::post(
        '/pengajuan-restock',
        [RestockRequestController::class, 'store']
    )->name('user.restock.store');


    /*
    |--------------------------------------------------------------------------
    | Riwayat Restock User
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/riwayat-restock',
        [RestockRequestController::class, 'history']
    )->name('user.restock.history');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    /*
    | Foto Profil
    */

    Route::post(
        '/profile/photo',
        [ProfileController::class, 'updatePhoto']
    )->name('profile.photo.update');

    Route::delete(
        '/profile/photo',
        [ProfileController::class, 'deletePhoto']
    )->name('profile.photo.delete');

    /*
    | Password
    */

    Route::patch(
        '/profile/password',
        [ProfileController::class, 'updatePassword']
    )->name('profile.password');

    /*
    | Hapus Akun
    */

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';