<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Menampilkan data buku.
     * Pencarian dilakukan di database dengan 5 buku per halaman.
     */
    public function index(Request $request)
    {
        $search = trim($request->query('search', ''));

        $books = Book::with('category')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                        ->orWhere('penerbit', 'like', '%' . $search . '%')
                        ->orWhere('pengarang', 'like', '%' . $search . '%')
                        ->orWhere('tahun_terbit', 'like', '%' . $search . '%')
                        ->orWhere('tahun_bantuan', 'like', '%' . $search . '%')
                        ->orWhereHas('category', function ($categoryQuery) use ($search) {
                            $categoryQuery
                                ->where('name', 'like', '%' . $search . '%')
                                ->orWhere('nama_kategori', 'like', '%' . $search . '%');
                        });
                });
            })
            ->orderByDesc('id')
            ->paginate(5)
            ->withQueryString();

        $totalBuku = Book::count();

        if ($request->user()?->role === 'admin') {
            return view('admin.books.index', compact(
                'books',
                'totalBuku',
                'search'
            ));
        }

        return view('user.books.index', compact(
            'books',
            'totalBuku',
            'search'
        ));
    }

    /**
     * Menampilkan form tambah buku.
     */
    public function create()
    {
        $categories = Category::all();

        return view('books.create', compact('categories'));
    }

    /**
     * Menyimpan buku baru beserta gambar jika tersedia.
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
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'image.image'  => 'File harus berupa gambar.',
            'image.mimes'  => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'image.max'    => 'Ukuran gambar maksimal 2 MB.',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('book-images', 'public');
        }

        Book::create($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit buku.
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Memperbarui data buku dan mengganti gambar jika dipilih.
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
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'image.image'  => 'File harus berupa gambar.',
            'image.mimes'  => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'image.max'    => 'Ukuran gambar maksimal 2 MB.',
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('image')) {
            // Simpan gambar baru terlebih dahulu.
            $newImage = $request->file('image')
                ->store('book-images', 'public');

            // Hapus gambar lama setelah gambar baru berhasil disimpan.
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }

            $validated['image'] = $newImage;
        } else {
            // Pertahankan gambar lama jika tidak memilih gambar baru.
            unset($validated['image']);
        }

        $book->update($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Menambahkan stok buku.
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
            ->with(
                'success',
                'Stok buku ' . $book->title . ' berhasil ditambah!'
            );
    }

    /**
     * Memindahkan buku ke Trash (Soft Delete).
     * Gambar tetap disimpan agar bisa digunakan kembali jika buku dipulihkan.
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
     * Menghapus buku secara permanen beserta gambar.
     */
    public function forceDelete($id)
    {
        $book = Book::onlyTrashed()->findOrFail($id);

        DB::transaction(function () use ($book) {
            $book->forceDelete();
        });

        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        return redirect()
            ->route('books.trash')
            ->with('success', 'Buku berhasil dihapus secara permanen!');
    }

    /**
     * Mengosongkan Trash beserta gambar buku yang dihapus permanen.
     */
    public function emptyTrash()
    {
        $books = Book::onlyTrashed()->get();

        DB::transaction(function () use ($books) {
            foreach ($books as $book) {
                $book->forceDelete();
            }
        });

        foreach ($books as $book) {
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
        }

        return redirect()
            ->route('books.trash')
            ->with('success', 'Trash berhasil dikosongkan!');
    }
}