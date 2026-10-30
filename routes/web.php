<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RestockRequestController;
use App\Http\Controllers\AdminRestockRequestController;
use App\Http\Controllers\RestockReportController;
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
    // EXPORT PDF DATA SELURUH BUKU
    // HARUS SEBELUM ROUTE RESOURCE BOOKS
    // ==========================================
    Route::get('/books/export-pdf', [BookController::class, 'exportPdf'])
        ->name('books.exportPdf');

    Route::get('/books/export/pdf-data', [BookController::class, 'exportPdfData'])
        ->name('books.export.pdf-data');

    // ==========================================
    // EXPORT DAN IMPORT EXCEL
    // ==========================================
    Route::post('/books/import-excel', [BookController::class, 'importExcel'])
        ->name('books.importExcel');

    Route::get('/books/export-excel', [BookController::class, 'exportExcel'])
        ->name('books.exportExcel');

    // Import data buku dari Excel (data dibaca di browser, disimpan lewat route ini)
    Route::post('/books/import-rows', [BookController::class, 'importRows'])
        ->name('books.importRows');

    // ==========================================
    // TRASH / SAMPAH BUKU
    // ROUTE KHUSUS SEBELUM RESOURCE BOOKS
    // ==========================================
    Route::get('/books-trash', [BookController::class, 'trash'])
        ->name('books.trash');

    Route::patch('/books-trash/{id}/restore', [BookController::class, 'restore'])
        ->name('books.restore');

    Route::delete('/books-trash/empty', [BookController::class, 'emptyTrash'])
        ->name('books.emptyTrash');

    Route::delete('/books-trash/{id}/force-delete', [BookController::class, 'forceDelete'])
        ->name('books.forceDelete');

    // ==========================================
    // RESOURCE DATA BUKU
    // LETAKKAN SETELAH ROUTE KHUSUS BUKU
    // ==========================================
    Route::resource('books', BookController::class);

    // ==========================================
    // RESTOCK LANGSUNG DARI DATA BUKU
    // ==========================================
    Route::post('/books/{id}/restock', [BookController::class, 'processRestock'])
        ->name('books.restock');

    // ==========================================
    // KATEGORI BUKU
    // ==========================================
    Route::resource('categories', CategoryController::class)
        ->except(['show', 'edit', 'update']);

    // ==========================================
    // PENGAJUAN RESTOCK USER
    // ==========================================
    Route::get('/pengajuan-restock', [RestockRequestController::class, 'index'])
        ->name('user.restock.index');

    Route::get('/pengajuan-restock/buat', [RestockRequestController::class, 'create'])
        ->name('user.restock.create');

    Route::post('/pengajuan-restock', [RestockRequestController::class, 'store'])
        ->name('user.restock.store');

    Route::get('/riwayat-restock', [RestockRequestController::class, 'history'])
        ->name('user.restock.history');

    // ==========================================
    // KELOLA PENGAJUAN RESTOCK ADMIN
    // ==========================================
    Route::get('/admin/pengajuan-restock', [AdminRestockRequestController::class, 'index'])
        ->name('admin.restock.index');

    Route::patch('/admin/pengajuan-restock/{id}/setujui', [AdminRestockRequestController::class, 'approve'])
        ->name('admin.restock.approve');

    Route::patch('/admin/pengajuan-restock/{id}/tolak', [AdminRestockRequestController::class, 'reject'])
        ->name('admin.restock.reject');

    // ==========================================
    // LAPORAN RESTOCK ADMIN
    // ==========================================
    Route::get('/admin/laporan-restock', [RestockReportController::class, 'index'])
        ->name('admin.restock.report');

    Route::get('/admin/laporan-restock/pdf', [RestockReportController::class, 'exportPdf'])
        ->name('admin.restock.report.pdf');

    // ==========================================
    // PROFIL
    // ==========================================
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])
        ->name('profile.photo.update');

    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])
        ->name('profile.photo.delete');

    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// ==========================================
// LOGIN, REGISTER, LOGOUT, RESET PASSWORD
// ==========================================
require __DIR__.'/auth.php';