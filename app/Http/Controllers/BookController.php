<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class BookController extends Controller
{
    /**
     * Menampilkan data buku.
     * Pencarian mendukung beberapa kata sekaligus.
     * Tetap menampilkan 5 buku per halaman.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        // Memisahkan kata pencarian berdasarkan spasi.
        $searchTerms = preg_split(
            '/\s+/u',
            $search,
            -1,
            PREG_SPLIT_NO_EMPTY
        ) ?: [];

        $books = Book::with('category')
            ->when(!empty($searchTerms), function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $keyword = '%' . $term . '%';

                    // Setiap kata harus cocok dengan minimal satu kolom.
                    $query->where(function ($q) use ($keyword) {
                        $q->where('title', 'like', $keyword)
                            ->orWhere('penerbit', 'like', $keyword)
                            ->orWhere('pengarang', 'like', $keyword)
                            ->orWhere('tahun_terbit', 'like', $keyword)
                            ->orWhere('tahun_bantuan', 'like', $keyword)
                            ->orWhereHas('category', function ($categoryQuery) use ($keyword) {
                                $categoryQuery->where(function ($categoryFields) use ($keyword) {
                                    $categoryFields->where('name', 'like', $keyword)
                                        ->orWhere('nama_kategori', 'like', $keyword);
                                });
                            });
                    });
                }
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
     * Mengunduh PDF seluruh data buku.
     * Tidak menggunakan pagination.
     */
    public function exportPdf()
    {
        $books = Book::with('category')
            ->orderByDesc('id')
            ->get();

        $pdf = Pdf::loadView('admin.books.pdf', [
            'books' => $books,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('daftar-buku-perpustakaan.pdf');
    }

    /**
     * Mengambil seluruh data buku untuk kebutuhan export PDF berbasis JSON.
     */
    public function exportPdfData()
    {
        $books = Book::with('category')
            ->orderByDesc('id')
            ->get()
            ->values()
            ->map(function ($book, $index) {
                $kategori = optional($book->category)->name
                    ?? optional($book->category)->nama_kategori
                    ?? '-';

                return [
                    'no' => $index + 1,
                    'judul' => $book->title ?? '-',
                    'penerbit' => $book->penerbit ?? '-',
                    'pengarang' => $book->pengarang ?? '-',
                    'tahun_terbit' => $book->tahun_terbit ?? '-',
                    'tahun_bantuan' => $book->tahun_bantuan ?? '-',
                    'kategori' => $kategori,
                    'stok' => $book->stock ?? 0,
                ];
            });

        return response()->json([
            'total' => $books->count(),
            'books' => $books,
        ]);
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
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'image.max'   => 'Ukuran gambar maksimal 2 MB.',
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
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'image.max'   => 'Ukuran gambar maksimal 2 MB.',
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('book-images', 'public');

            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }

            $validated['image'] = $newImage;
        } else {
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

        $image = $book->image;

        DB::transaction(function () use ($book) {
            $book->forceDelete();
        });

        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return redirect()
            ->route('books.trash')
            ->with('success', 'Buku berhasil dihapus secara permanen!');
    }

    /**
     * Mengosongkan Trash beserta gambar buku.
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