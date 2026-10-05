<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // 1. Menampilkan daftar semua buku (Dipisah otomatis: Admin atau User)
    public function index(Request $request)
    {
        $user = $request->user();
        $books = Book::all();

        // Jika yang login adalah admin
        if ($user && $user->role === 'admin') {
            return view('admin.books.index', compact('books'));
        }

        // Jika yang login adalah user biasa
        return view('user.books.index', compact('books'));
    }

    // 2. Form tambah buku baru
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    // 3. Menyimpan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'category_id' => 'required|exists:categories,id',
            'stock'       => 'required|integer',
        ]);

        Book::create($request->only(['title', 'category_id', 'stock']));

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    // 4. Form Edit buku
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    // 5. Update data buku
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required',
            'category_id' => 'required|exists:categories,id',
            'stock'       => 'required|integer',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->only(['title', 'category_id', 'stock']));

        return redirect()->route('books.index')->with('success', 'Data buku berhasil diupdate!');
    }

    // 6. Logika khusus restock
    public function processRestock(Request $request, $id)
    {
        $request->validate([
            'added_stock' => 'required|integer|min:1',
        ]);

        $book = Book::findOrFail($id);
        
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