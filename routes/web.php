<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RestockRequestController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('books', BookController::class);

    Route::resource('categories', CategoryController::class)
        ->except(['show', 'edit', 'update']);

    Route::post(
        '/books/{id}/restock',
        [BookController::class, 'processRestock']
    )->name('books.restock');

    Route::get(
        '/pengajuan-restock',
        [RestockRequestController::class, 'create']
    )->name('user.restock.create');

    Route::post(
        '/pengajuan-restock',
        [RestockRequestController::class, 'store']
    )->name('user.restock.store');

    Route::get(
        '/riwayat-restock',
        [RestockRequestController::class, 'history']
    )->name('user.restock.history');

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::post(
        '/profile/photo',
        [ProfileController::class, 'updatePhoto']
    )->name('profile.photo.update');

    Route::delete(
        '/profile/photo',
        [ProfileController::class, 'deletePhoto']
    )->name('profile.photo.delete');

    Route::patch(
        '/profile/password',
        [ProfileController::class, 'updatePassword']
    )->name('profile.password');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');
});

require __DIR__.'/auth.php';