<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RestockRequestController;
use App\Http\Controllers\AdminRestockRequestController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

// HALAMAN AWAL
Route::get('/', function () {
    return redirect()->route('login');
});

// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    // ==============================
    // DATA BUKU
    // ==============================
    Route::resource('books', BookController::class);

    // RESTOCK DARI HALAMAN DATA BUKU
    Route::post(
        '/books/{id}/restock',
        [BookController::class, 'processRestock']
    )->name('books.restock');


    // ==============================
    // KATEGORI BUKU
    // ==============================
    Route::resource('categories', CategoryController::class)
        ->except(['show', 'edit', 'update']);


    // ==============================
    // SUPPLIER
    // ==============================
    Route::resource('suppliers', SupplierController::class)
        ->only(['index', 'store', 'destroy'])
        ->names('suppliers');


    // ==============================
    // PENGAJUAN RESTOCK USER
    // ==============================

    // Halaman utama pengajuan restock
    Route::get(
        '/pengajuan-restock',
        [RestockRequestController::class, 'index']
    )->name('user.restock.index');

    // Form untuk membuat pengajuan
    Route::get(
        '/pengajuan-restock/buat',
        [RestockRequestController::class, 'create']
    )->name('user.restock.create');

    // Menyimpan pengajuan restock
    Route::post(
        '/pengajuan-restock',
        [RestockRequestController::class, 'store']
    )->name('user.restock.store');

    // Riwayat pengajuan restock user
    Route::get(
        '/riwayat-restock',
        [RestockRequestController::class, 'history']
    )->name('user.restock.history');


    // ==============================
    // KELOLA PENGAJUAN RESTOCK ADMIN
    // ==============================

    // Daftar pengajuan restock
    Route::get(
        '/admin/pengajuan-restock',
        [AdminRestockRequestController::class, 'index']
    )->name('admin.restock.index');

    // Menyetujui pengajuan
    Route::patch(
        '/admin/pengajuan-restock/{id}/setujui',
        [AdminRestockRequestController::class, 'approve']
    )->name('admin.restock.approve');

    // Menolak pengajuan
    Route::patch(
        '/admin/pengajuan-restock/{id}/tolak',
        [AdminRestockRequestController::class, 'reject']
    )->name('admin.restock.reject');


    // ==============================
    // PROFIL
    // ==============================

    // Halaman profil
    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    // Memperbarui profil
    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    // Mengunggah foto profil
    Route::post(
        '/profile/photo',
        [ProfileController::class, 'updatePhoto']
    )->name('profile.photo.update');

    // Menghapus foto profil
    Route::delete(
        '/profile/photo',
        [ProfileController::class, 'deletePhoto']
    )->name('profile.photo.delete');

    // Memperbarui password
    Route::patch(
        '/profile/password',
        [ProfileController::class, 'updatePassword']
    )->name('profile.password');

    // Menghapus akun
    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');
});


// ROUTE LOGIN, REGISTER, LOGOUT, DAN AUTENTIKASI
require __DIR__.'/auth.php';