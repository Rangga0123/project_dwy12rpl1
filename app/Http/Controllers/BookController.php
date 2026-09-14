<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // 1. Menampilkan daftar semua buku
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // 2. Form tambah buku baru
    public function create()
    {
        return view('books.create');
    }

    // 3. Menyimpan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required',
            'author' => 'required',
            'stock'  => 'required|integer',
        ]);

        Book::create($request->only(['title', 'author', 'stock']));

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    // 4. Form Edit buku
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    // 5. Update data buku (edit biasa)
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'  => 'required',
            'author' => 'required',
            'stock'  => 'required|integer',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->only(['title', 'author', 'stock']));

        return redirect()->route('books.index')->with('success', 'Data buku berhasil diupdate!');
    }

    // 6. LOGIKA KHUSUS RESTOCK (Menambah stok ke yang sudah ada)
    public function processRestock(Request $request, $id)
    {
        $request->validate([
            'added_stock' => 'required|integer|min:1',
        ]);

        $book = Book::findOrFail($id);
        
        // Logika Matematika: Stok lama + Stok yang baru ditambahkan
        $book->stock = $book->stock + $request->added_stock;
        $book->save();

        return redirect()->route('books.index')->with('success', 'Stok ' . $book->title . ' berhasil ditambah!');
    }

    // 7. Menghapus buku
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}