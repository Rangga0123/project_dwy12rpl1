<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\RestockRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RestockRequestController extends Controller
{
    /**
     * Halaman pengajuan restock user
     */
    public function create(): View
    {
        $books = Book::orderBy('title')->get();

        return view('user.create', compact('books'));
    }

    /**
     * Menyimpan pengajuan restock
     */
 public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // PERBAIKAN DI SINI: ubah 'restocks' menjadi 'books'
            'book_id' => ['required', 'exists:books,id'],
            'jumlah' => ['required', 'integer', 'min:1'],
            'alasan' => ['nullable', 'string', 'max:1000'],
        ], [
            'book_id.required' => 'Buku wajib dipilih.',
            'book_id.exists' => 'Buku tidak ditemukan.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah minimal 1.',
            'alasan.max' => 'Alasan maksimal 1000 karakter.',
        ]);

        RestockRequest::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'jumlah' => $request->jumlah,
            'alasan' => $request->alasan,
            'status' => 'menunggu',
        ]);

        return redirect()
            ->route('user.restock.create')
            ->with('success', 'Pengajuan restock berhasil dikirim.');
    }

    /**
     * Riwayat pengajuan user
     */
    public function history(): View
    {
        $requests = RestockRequest::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.history', compact('requests'));
    }
}