<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RestockRequestController;
use App\Http\Controllers\AdminRestockRequestController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// ==========================================
// HALAMAN AWAL
// ==========================================
Route::get('/', function () {
    return redirect()->route('login');
});

// ==========================================
// DASHBOARD
// ==========================================
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ==========================================
// SEMUA ROUTE YANG MEMERLUKAN LOGIN
// ==========================================
Route::middleware('auth')->group(function () {

    // ==========================================
    // DATA BUKU
    // ==========================================

    // Daftar buku, tambah, simpan, detail, edit, update, hapus
    Route::resource('books', BookController::class);

    // ==========================================
    // TRASH / SAMPAH BUKU
    // ==========================================

    // Menampilkan buku yang sudah masuk Trash
    Route::get('/books-trash', [BookController::class, 'trash'])
        ->name('books.trash');

    // Memulihkan buku dari Trash
    Route::patch('/books-trash/{id}/restore', [BookController::class, 'restore'])
        ->name('books.restore');

    // Menghapus buku secara permanen
    Route::delete('/books-trash/{id}/force-delete', [BookController::class, 'forceDelete'])
        ->name('books.forceDelete');

    // Mengosongkan Trash
    Route::delete('/books-trash/empty', [BookController::class, 'emptyTrash'])
        ->name('books.emptyTrash');

    // ==========================================
    // RESTOCK LANGSUNG DARI DATA BUKU
    // ==========================================
    Route::post('/books/{id}/restock', [BookController::class, 'processRestock'])
        ->name('books.restock');

    // ==========================================
    // IMPORT DAN EXPORT BUKU
    // ==========================================

    // Import Excel
    Route::post('/books/import-excel', [BookController::class, 'importExcel'])
        ->name('books.importExcel');

    // Export Excel
    Route::get('/books/export-excel', [BookController::class, 'exportExcel'])
        ->name('books.exportExcel');

    // Export PDF
    Route::get('/books/export-pdf', [BookController::class, 'exportPdf'])
        ->name('books.exportPdf');

    // ==========================================
    // KATEGORI BUKU
    // ==========================================
    Route::resource('categories', CategoryController::class)
        ->except(['show', 'edit', 'update']);

    // ==========================================
    // PENGAJUAN RESTOCK USER
    // ==========================================

    // Daftar pengajuan
    Route::get('/pengajuan-restock', [RestockRequestController::class, 'index'])
        ->name('user.restock.index');

    // Form pengajuan baru
    Route::get('/pengajuan-restock/buat', [RestockRequestController::class, 'create'])
        ->name('user.restock.create');

    // Simpan pengajuan
    Route::post('/pengajuan-restock', [RestockRequestController::class, 'store'])
        ->name('user.restock.store');

    // Riwayat pengajuan
    Route::get('/riwayat-restock', [RestockRequestController::class, 'history'])
        ->name('user.restock.history');

    // ==========================================
    // KELOLA PENGAJUAN RESTOCK ADMIN
    // ==========================================

    // Daftar pengajuan
    Route::get('/admin/pengajuan-restock', [AdminRestockRequestController::class, 'index'])
        ->name('admin.restock.index');

    // Setujui pengajuan
    Route::patch('/admin/pengajuan-restock/{id}/setujui', [AdminRestockRequestController::class, 'approve'])
        ->name('admin.restock.approve');

    // Tolak pengajuan
    Route::patch('/admin/pengajuan-restock/{id}/tolak', [AdminRestockRequestController::class, 'reject'])
        ->name('admin.restock.reject');

    // ==========================================
    // PROFIL
    // ==========================================

    // Halaman profil
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    // Update informasi profil
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // Upload foto profil
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])
        ->name('profile.photo.update');

    // Hapus foto profil
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])
        ->name('profile.photo.delete');

    // Update password
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');

    // Hapus akun
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// ==========================================
// LOGIN, REGISTER, LOGOUT, RESET PASSWORD
// ==========================================
require __DIR__.'/auth.php';