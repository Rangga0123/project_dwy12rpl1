<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\RestockRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminRestockRequestController extends Controller
{
    /**
     * Pastikan hanya admin yang dapat mengelola pengajuan.
     */
    private function pastikanAdmin(): void
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
    }

    /**
     * Menampilkan seluruh pengajuan restock.
     */
    public function index(): View
    {
        $this->pastikanAdmin();

        // Mengambil seluruh pengajuan beserta data user dan buku.
        $requests = RestockRequest::with(['user', 'book'])
            ->latest()
            ->get();

        // Mengambil data buku untuk dropdown atau pilihan buku di Blade.
        $books = Book::all();

        // Statistik pengajuan restock.
        $totalPengajuan = RestockRequest::count();

        $totalMenunggu = RestockRequest::where(
            'status',
            'menunggu'
        )->count();

        $totalDisetujui = RestockRequest::where(
            'status',
            'disetujui'
        )->count();

        $totalDitolak = RestockRequest::where(
            'status',
            'ditolak'
        )->count();

        return view('Admin.pengajuan-restock', compact(
            'requests',
            'books',
            'totalPengajuan',
            'totalMenunggu',
            'totalDisetujui',
            'totalDitolak'
        ));
    }

    /**
     * Menyetujui pengajuan.
     */
    public function approve(Request $request, int $id): RedirectResponse
    {
        $this->pastikanAdmin();

        $request->validate([
            'catatan_admin' => ['nullable', 'string', 'max:1000'],
        ]);

        $pengajuan = RestockRequest::findOrFail($id);

        if ($pengajuan->status !== 'menunggu') {
            return back()->with(
                'error',
                'Pengajuan ini sudah diproses.'
            );
        }

        $pengajuan->update([
            'status' => 'disetujui',
            'catatan_admin' => $request->input('catatan_admin'),
        ]);

        return back()->with(
            'success',
            'Pengajuan berhasil disetujui.'
        );
    }

    /**
     * Menolak pengajuan.
     */
    public function reject(Request $request, int $id): RedirectResponse
    {
        $this->pastikanAdmin();

        $request->validate([
            'catatan_admin' => ['required', 'string', 'max:1000'],
        ], [
            'catatan_admin.required' => 'Alasan penolakan wajib diisi.',
        ]);

        $pengajuan = RestockRequest::findOrFail($id);

        if ($pengajuan->status !== 'menunggu') {
            return back()->with(
                'error',
                'Pengajuan ini sudah diproses.'
            );
        }

        $pengajuan->update([
            'status' => 'ditolak',
            'catatan_admin' => $request->input('catatan_admin'),
        ]);

        return back()->with(
            'success',
            'Pengajuan berhasil ditolak.'
        );
    }
}