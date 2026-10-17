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
     * Halaman utama Pengajuan Restock user.
     */
    public function index(): View
    {
        abort_unless(auth()->user()?->role === 'user', 403);

        $requests = RestockRequest::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.Restock.index', compact('requests'));
    }

    /**
     * Halaman formulir pengajuan restock user.
     */
    public function create(): View
    {
        abort_unless(auth()->user()?->role === 'user', 403);

        // Mengambil data buku untuk pilihan pada formulir.
        $books = Book::orderBy('title')->get();

        return view('user.Restock.create', compact('books'));
    }

    /**
     * Memvalidasi dan menyimpan pengajuan restock.
     */
    public function store(Request $request): RedirectResponse
    {
        abort_unless(auth()->user()?->role === 'user', 403);

        $validated = $request->validate([
            'book_id' => [
                'required',
                'integer',
                'exists:books,id',
            ],
            'jumlah' => [
                'required',
                'integer',
                'min:1',
            ],
            'alasan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'book_id.required' => 'Buku wajib dipilih.',
            'book_id.integer' => 'Pilihan buku tidak valid.',
            'book_id.exists' => 'Buku tidak ditemukan.',
            'jumlah.required' => 'Jumlah buku wajib diisi.',
            'jumlah.integer' => 'Jumlah buku harus berupa angka bulat.',
            'jumlah.min' => 'Jumlah buku minimal 1.',
            'alasan.string' => 'Alasan pengajuan harus berupa teks.',
            'alasan.max' => 'Alasan maksimal 1000 karakter.',
        ]);

        RestockRequest::create([
            'user_id' => auth()->id(),
            'book_id' => $validated['book_id'],
            'jumlah' => $validated['jumlah'],
            'alasan' => $validated['alasan'] ?? null,
            'status' => 'menunggu',
        ]);

        return redirect()
            ->route('user.restock.index')
            ->with('success', 'Pengajuan restock berhasil dikirim.');
    }

    /**
     * Halaman riwayat pengajuan restock user.
     */
    public function history(): View
    {
        abort_unless(auth()->user()?->role === 'user', 403);

        $requests = RestockRequest::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.history', compact('requests'));
    }
}