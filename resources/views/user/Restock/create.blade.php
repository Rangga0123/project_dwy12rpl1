@extends('user.layouts.app')

@section('title', 'Buat Pengajuan Restock')

@push('styles')
<style>
    .page-title {
        color: var(--brown);
        letter-spacing: -.45px;
    }

    .card {
        background: white;
        border: 1px solid var(--line);
        border-radius: 12px;
        box-shadow: 0 2px 7px rgba(55,35,24,.035);
        animation: rise-in .4s both;
    }

    .primary-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        background: var(--brown);
        color: white;
        border: 1px solid var(--brown);
        border-radius: 8px;
        padding: 12px 18px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s ease, transform .2s ease;
    }

    .primary-btn:hover {
        background: var(--brown-dark);
        transform: translateY(-1px);
    }

    .primary-btn:disabled {
        opacity: .6;
        cursor: not-allowed;
        transform: none;
    }

    .secondary-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #f5eee8;
        color: var(--brown);
        border: 1px solid #eaded5;
        border-radius: 8px;
        padding: 11px 15px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .secondary-btn:hover { background: #eee1d7; }

    .form-label {
        display: block;
        color: #44403c;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .form-control {
        display: block;
        width: 100%;
        min-height: 46px;
        border: 1px solid #ded6d0;
        border-radius: 8px;
        background: white;
        padding: 11px 13px;
        color: #292524;
        font-size: 14px;
        outline: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .form-control:focus {
        border-color: var(--orange);
        box-shadow: 0 0 0 3px rgba(217,107,36,.12);
    }

    .form-control::placeholder { color: #a8a29e; }

    textarea.form-control {
        min-height: 125px;
        resize: vertical;
    }

    .field-error {
        color: #b91c1c;
        font-size: 12px;
        margin-top: 6px;
    }

    .section-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: grid;
        place-items: center;
        background: #f5eee8;
        color: var(--brown);
        font-size: 21px;
        flex-shrink: 0;
    }

    .notice {
        border: 1px solid #eaded5;
        background: #faf6f2;
        border-radius: 9px;
        padding: 14px;
    }

    @keyframes rise-in {
        from { opacity: 0; transform: translateY(9px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
<section class="content-area p-7 lg:p-8">

    <!-- JUDUL -->
    <div class="mb-6" style="animation: rise-in .4s both;">

        <a
            href="{{ route('user.restock.index') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold brown mb-4 hover:underline"
        >
            <span>←</span>
            Kembali ke Pengajuan Restock
        </a>

        <p class="text-xs uppercase tracking-wider text-stone-500 mb-2">
            Sistem Informasi Perpustakaan
        </p>

        <h2 class="page-title text-3xl font-bold">
            Buat Pengajuan Restock
        </h2>

        <p class="text-sm text-stone-600 mt-2 leading-6">
            Halo, <strong class="brown">{{ Auth::user()->name ?? 'User' }}</strong>.
            Lengkapi formulir berikut untuk mengajukan penambahan stok buku.
        </p>
    </div>

    <!-- ERROR VALIDASI -->
    @if ($errors->any())
        <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-4 text-sm text-red-800" role="alert">
            <p class="font-bold mb-2">
                Ada data yang perlu diperbaiki:
            </p>

            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- FORMULIR -->
        <div class="xl:col-span-2">

            <div class="card overflow-hidden">

                <div class="px-5 sm:px-7 py-5 border-b border-stone-200">
                    <div class="flex items-center gap-3">
                        <div class="section-icon">▤</div>

                        <div>
                            <h3 class="text-lg font-bold brown">
                                Informasi Pengajuan
                            </h3>

                            <p class="text-sm text-stone-500 mt-1">
                                Isi semua kolom yang wajib diisi.
                            </p>
                        </div>
                    </div>
                </div>

                <form
                    action="{{ route('user.restock.store') }}"
                    method="POST"
                    id="restockForm"
                >
                    @csrf

                    <div class="p-5 sm:p-7 space-y-6">

                        <!-- PILIH BUKU -->
                        <div>
                            <label for="book_id" class="form-label">
                                Pilih Buku
                                <span class="text-red-600">*</span>
                            </label>

                            <select
                                id="book_id"
                                name="book_id"
                                required
                                class="form-control"
                            >
                                <option value="">-- Pilih Buku --</option>

                                @forelse ($books as $book)
                                    <option
                                        value="{{ $book->id }}"
                                        data-title="{{ $book->title }}"
                                        data-stock="{{ $book->stock ?? 0 }}"
                                        {{ (string) old('book_id') === (string) $book->id ? 'selected' : '' }}
                                    >
                                        {{ $book->title }}
                                        — Stok: {{ $book->stock ?? 0 }}
                                    </option>
                                @empty
                                    <option value="" disabled>
                                        Belum ada data buku
                                    </option>
                                @endforelse
                            </select>

                            @error('book_id')
                                <p class="field-error">{{ $message }}</p>
                            @enderror

                            <p class="text-xs text-stone-500 mt-2">
                                Pilih buku yang ingin ditambah stoknya.
                            </p>

                            <div id="selectedBookInfo" class="notice mt-3 hidden">
                                <p class="text-xs text-stone-500">
                                    Buku yang dipilih
                                </p>

                                <p id="selectedBookTitle" class="font-bold brown mt-1"></p>

                                <p class="text-sm text-stone-600 mt-2">
                                    Stok saat ini:
                                    <strong id="selectedBookStock">0</strong>
                                </p>
                            </div>
                        </div>

                        <!-- JUMLAH -->
                        <div>
                            <label for="jumlah" class="form-label">
                                Jumlah Buku yang Diajukan
                                <span class="text-red-600">*</span>
                            </label>

                            <input
                                type="number"
                                id="jumlah"
                                name="jumlah"
                                min="1"
                                step="1"
                                value="{{ old('jumlah', 1) }}"
                                required
                                placeholder="Masukkan jumlah buku"
                                class="form-control"
                            >

                            @error('jumlah')
                                <p class="field-error">{{ $message }}</p>
                            @enderror

                            <p class="text-xs text-stone-500 mt-2">
                                Masukkan jumlah buku yang dibutuhkan. Minimal 1 buku.
                            </p>
                        </div>

                        <!-- ALASAN -->
                        <div>
                            <label for="alasan" class="form-label">
                                Alasan Pengajuan
                                <span class="text-stone-400 font-normal">
                                    (Opsional)
                                </span>
                            </label>

                            <textarea
                                id="alasan"
                                name="alasan"
                                rows="4"
                                maxlength="1000"
                                placeholder="Contoh: Stok buku mulai menipis dan masih dibutuhkan oleh siswa."
                                class="form-control"
                            >{{ old('alasan') }}</textarea>

                            @error('alasan')
                                <p class="field-error">{{ $message }}</p>
                            @enderror

                            <div class="flex justify-between gap-3 mt-2">
                                <p class="text-xs text-stone-500">
                                    Jelaskan alasan penambahan stok jika diperlukan.
                                </p>

                                <p class="text-xs text-stone-400 whitespace-nowrap">
                                    <span id="alasanCount">0</span>/1000
                                </p>
                            </div>
                        </div>

                        <!-- INFORMASI -->
                        <div class="notice">
                            <div class="flex items-start gap-3">
                                <div class="text-lg brown">ⓘ</div>

                                <div>
                                    <p class="text-sm font-bold brown">
                                        Informasi Pengajuan
                                    </p>

                                    <p class="text-sm text-stone-600 leading-6 mt-1">
                                        Setelah dikirim, status pengajuan akan menjadi
                                        <strong>Menunggu</strong> sampai admin memeriksa
                                        permintaanmu. Kamu dapat melihat perkembangan
                                        pengajuan melalui halaman Riwayat Restock.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- TOMBOL -->
                        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-2">

                            <a
                                href="{{ route('user.restock.index') }}"
                                class="secondary-btn"
                            >
                                Batal
                            </a>

                            <button
                                type="submit"
                                id="submitButton"
                                class="primary-btn"
                                {{ $books->isEmpty() ? 'disabled' : '' }}
                            >
                                <span>✓</span>
                                Kirim Pengajuan
                            </button>

                        </div>

                        @if ($books->isEmpty())
                            <p class="text-sm text-red-600">
                                Data buku masih kosong. Pengajuan belum dapat dibuat
                                sampai buku ditambahkan ke Data Buku.
                            </p>
                        @endif

                    </div>
                </form>
            </div>
        </div>

        <!-- PANEL SAMPING -->
        <aside class="space-y-5">

            <div class="card p-5">
                <div class="flex items-center gap-3 mb-5">
                    <div class="section-icon">ⓘ</div>

                    <h3 class="font-bold brown">
                        Alur Pengajuan
                    </h3>
                </div>

                <div class="space-y-5">

                    <div class="flex items-start gap-3">
                        <div class="section-icon !w-9 !h-9 !text-sm">01</div>

                        <div>
                            <p class="text-sm font-bold brown">Pilih Buku</p>

                            <p class="text-xs text-stone-500 leading-5 mt-1">
                                Pilih buku yang tersedia pada Data Buku.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="section-icon !w-9 !h-9 !text-sm">02</div>

                        <div>
                            <p class="text-sm font-bold brown">Isi Formulir</p>

                            <p class="text-xs text-stone-500 leading-5 mt-1">
                                Tentukan jumlah buku dan tulis alasan jika diperlukan.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="section-icon !w-9 !h-9 !text-sm">03</div>

                        <div>
                            <p class="text-sm font-bold brown">Pantau Status</p>

                            <p class="text-xs text-stone-500 leading-5 mt-1">
                                Tunggu admin memeriksa pengajuanmu.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card p-5">
                <div class="flex items-center gap-3 mb-4">
                    <div class="section-icon">◷</div>

                    <h3 class="font-bold brown">
                        Status Pengajuan
                    </h3>
                </div>

                <div class="space-y-4">

                    <div class="flex items-start gap-3">
                        <span class="mt-1.5 w-2.5 h-2.5 rounded-full bg-orange-500 shrink-0"></span>

                        <div>
                            <p class="text-sm font-semibold text-stone-700">Menunggu</p>
                            <p class="text-xs text-stone-500 mt-1">
                                Pengajuan belum diputuskan admin.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <span class="mt-1.5 w-2.5 h-2.5 rounded-full bg-green-600 shrink-0"></span>

                        <div>
                            <p class="text-sm font-semibold text-stone-700">Disetujui</p>
                            <p class="text-xs text-stone-500 mt-1">
                                Pengajuan disetujui admin.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <span class="mt-1.5 w-2.5 h-2.5 rounded-full bg-red-600 shrink-0"></span>

                        <div>
                            <p class="text-sm font-semibold text-stone-700">Ditolak</p>
                            <p class="text-xs text-stone-500 mt-1">
                                Pengajuan tidak disetujui admin.
                            </p>
                        </div>
                    </div>

                </div>

                <a
                    href="{{ route('user.restock.history') }}"
                    class="secondary-btn w-full mt-5"
                >
                    Lihat Riwayat Restock →
                </a>
            </div>

        </aside>
    </div>

    <footer class="text-center text-xs text-stone-400 mt-8">
        © {{ date('Y') }} Book Stock SMKN 5 · Sistem Restock Buku Perpustakaan
    </footer>

</section>
@endsection

@push('scripts')
<script>
    // Informasi buku yang dipilih
    const bookSelect = document.getElementById('book_id');
    const selectedBookInfo = document.getElementById('selectedBookInfo');
    const selectedBookTitle = document.getElementById('selectedBookTitle');
    const selectedBookStock = document.getElementById('selectedBookStock');

    function updateSelectedBook() {
        const option = bookSelect?.selectedOptions[0];

        if (option && option.value !== '') {
            selectedBookTitle.textContent = option.dataset.title || option.textContent.trim();
            selectedBookStock.textContent = option.dataset.stock || '0';
            selectedBookInfo.classList.remove('hidden');
        } else {
            selectedBookInfo.classList.add('hidden');
        }
    }

    bookSelect?.addEventListener('change', updateSelectedBook);
    updateSelectedBook();

    // Penghitung karakter alasan
    const alasanInput = document.getElementById('alasan');
    const alasanCount = document.getElementById('alasanCount');

    function updateAlasanCount() {
        alasanCount.textContent = alasanInput.value.length;
    }

    alasanInput?.addEventListener('input', updateAlasanCount);
    updateAlasanCount();

    // Mencegah klik kirim berulang
    const restockForm = document.getElementById('restockForm');
    const submitButton = document.getElementById('submitButton');

    restockForm?.addEventListener('submit', () => {
        if (restockForm.checkValidity() && !submitButton.disabled) {
            submitButton.disabled = true;
            submitButton.textContent = 'Mengirim pengajuan...';
        }
    });
</script>
@endpush