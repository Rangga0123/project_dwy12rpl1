<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
                                $categoryQuery->where(
                                    'name',
                                    'like',
                                    $keyword
                                );
                            });
                    });
                }
            })
            // ---------- FILTER ----------
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->when($request->query('stok') === 'menipis', function ($query) {
                $query->where('stock', '<=', 5);
            })
            ->when($request->query('stok') === 'aman', function ($query) {
                $query->where('stock', '>', 5);
            })
            ->when($request->filled('tahun_terbit'), function ($query) use ($request) {
                $query->where('tahun_terbit', $request->tahun_terbit);
            })
            ->when($request->filled('tahun_bantuan'), function ($query) use ($request) {
                $query->where('tahun_bantuan', $request->tahun_bantuan);
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $totalBuku = Book::count();

        // Data untuk pilihan filter
        $categories = Category::orderBy('name')->get();

        $tahunTerbitList = Book::whereNotNull('tahun_terbit')
            ->distinct()
            ->orderByDesc('tahun_terbit')
            ->pluck('tahun_terbit');

        $tahunBantuanList = Book::whereNotNull('tahun_bantuan')
            ->distinct()
            ->orderByDesc('tahun_bantuan')
            ->pluck('tahun_bantuan');

        if ($request->user()?->role === 'admin') {
            return view('admin.books.index', compact(
                'books',
                'totalBuku',
                'search',
                'categories',
                'tahunTerbitList',
                'tahunBantuanList'
            ));
        }

        return view('user.books.index', compact(
            'books',
            'totalBuku',
            'search',
            'categories',
            'tahunTerbitList',
            'tahunBantuanList'
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
                $kategori = optional($book->category)->name ?? '-';

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
     * Import data buku dari Excel.
     * File dibaca di browser (SheetJS), lalu baris datanya dikirim ke sini.
     * Aturan validasi tiap baris sama dengan form Tambah Buku.
     */
    public function importRows(Request $request)
    {
        $request->validate([
            'rows' => 'required|array|min:1|max:1000',
        ]);

        $added   = 0;
        $skipped = 0;
        $failed  = [];

        foreach ($request->rows as $index => $row) {
            $nomorBaris = $index + 2; // baris 1 di Excel adalah header

            $data = [
                'title'         => trim((string) ($row['title'] ?? '')),
                'penerbit'      => trim((string) ($row['penerbit'] ?? '')),
                'pengarang'     => trim((string) ($row['pengarang'] ?? '')),
                'tahun_terbit'  => preg_replace('/\D/', '', (string) ($row['tahun_terbit'] ?? '')),
                'tahun_bantuan' => preg_replace('/\D/', '', (string) ($row['tahun_bantuan'] ?? '')),
                'kategori'      => trim((string) ($row['kategori'] ?? '')),
                'stock'         => preg_replace('/\D/', '', (string) ($row['stock'] ?? '')),
            ];

            if ($data['stock'] === '') {
                $data['stock'] = '0';
            }

            $validator = Validator::make($data, [
                'title'         => 'required|string|max:255',
                'penerbit'      => 'required|string|max:255',
                'pengarang'     => 'required|string|max:255',
                'tahun_terbit'  => 'required|integer|min:1000|max:9999',
                'tahun_bantuan' => 'required|integer|min:1000|max:9999',
                'kategori'      => 'required|string|max:255',
                'stock'         => 'required|integer|min:0',
            ]);

            if ($validator->fails()) {
                $failed[] = "Baris {$nomorBaris}: " . $validator->errors()->first();
                continue;
            }

            // Lewati kalau buku dengan judul + pengarang yang sama sudah ada
            $exists = Book::whereRaw('LOWER(title) = ?', [mb_strtolower($data['title'])])
                ->whereRaw('LOWER(pengarang) = ?', [mb_strtolower($data['pengarang'])])
                ->exists();

            if ($exists) {
                $skipped++;
                continue;
            }

            // Cocokkan nama kategori (dibuat otomatis kalau belum ada)
            $category = Category::whereRaw('LOWER(name) = ?', [mb_strtolower($data['kategori'])])->first();

            if (!$category) {
                $category = new Category();
                $category->name = $data['kategori'];
                $category->save();
            }

            Book::create([
                'title'         => $data['title'],
                'penerbit'      => $data['penerbit'],
                'pengarang'     => $data['pengarang'],
                'tahun_terbit'  => (int) $data['tahun_terbit'],
                'tahun_bantuan' => (int) $data['tahun_bantuan'],
                'category_id'   => $category->id,
                'stock'         => (int) $data['stock'],
            ]);

            $added++;
        }

        $message = "Import selesai: {$added} buku ditambahkan, {$skipped} dilewati (sudah ada)";

        if (count($failed) > 0) {
            $message .= ', ' . count($failed) . ' gagal.';
            $message .= "\n\n" . implode("\n", array_slice($failed, 0, 5));

            if (count($failed) > 5) {
                $message .= "\n...dan " . (count($failed) - 5) . ' baris lainnya.';
            }
        } else {
            $message .= '.';
        }

        return response()->json([
            'message' => $message,
            'added'   => $added,
            'skipped' => $skipped,
            'failed'  => count($failed),
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