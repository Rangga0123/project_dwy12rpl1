<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Menampilkan daftar buku.
     */
    public function index(Request $request)
    {
        $books = Book::with('category')->get();

        if ($request->user()?->role === 'admin') {
            return view('admin.books.index', compact('books'));
        }

        return view('user.books.index', compact('books'));
    }

    /**
     * Form tambah buku.
     */
    public function create()
    {
        $categories = Category::all();

        return view('books.create', compact('categories'));
    }

    /**
     * Menyimpan buku baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'penerbit'      => 'required|string|max:255',
            'pengarang'     => 'required|string|max:255',
            'tahun_terbit'  => 'required|integer|min:1000|max:9999',
            'tahun_bantuan' => 'required|integer|min:1000|max:9999',
            'category_id'   => 'required|exists:categories,id',
            'stock'         => 'required|integer|min:0',
        ]);

        Book::create($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Form edit buku.
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Memperbarui data buku.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'penerbit'      => 'required|string|max:255',
            'pengarang'     => 'required|string|max:255',
            'tahun_terbit'  => 'required|integer|min:1000|max:9999',
            'tahun_bantuan' => 'required|integer|min:1000|max:9999',
            'category_id'   => 'required|exists:categories,id',
            'stock'         => 'required|integer|min:0',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Menambah stok buku.
     */
    public function processRestock(Request $request, $id)
    {
        $validated = $request->validate([
            'added_stock' => 'required|integer|min:1',
        ]);

        $book = Book::findOrFail($id);
        $book->increment('stock', $validated['added_stock']);

        return redirect()
            ->route('books.index')
            ->with('success', 'Stok buku ' . $book->title . ' berhasil ditambah!');
    }

    /**
     * Memindahkan buku ke Trash.
     * Memerlukan SoftDeletes pada model dan tabel books.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil dipindahkan ke Trash!');
    }

    /**
     * Menampilkan buku yang ada di Trash.
     */
    public function trash()
    {
        $books = Book::onlyTrashed()
            ->with('category')
            ->orderByDesc('deleted_at')
            ->get();

        return view('admin.books.trash', compact('books'));
    }

    /**
     * Memulihkan buku dari Trash.
     */
    public function restore($id)
    {
        $book = Book::onlyTrashed()->findOrFail($id);
        $book->restore();

        return redirect()
            ->route('books.trash')
            ->with('success', 'Buku berhasil dipulihkan!');
    }

    /**
     * Menghapus buku secara permanen.
     */
    public function forceDelete($id)
    {
        $book = Book::onlyTrashed()->findOrFail($id);
        $book->forceDelete();

        return redirect()
            ->route('books.trash')
            ->with('success', 'Buku berhasil dihapus secara permanen!');
    }

    /**
     * Mengosongkan Trash.
     */
    public function emptyTrash()
    {
        DB::transaction(function () {
            Book::onlyTrashed()->forceDelete();
        });

        return redirect()
            ->route('books.trash')
            ->with('success', 'Trash berhasil dikosongkan!');
    }
}