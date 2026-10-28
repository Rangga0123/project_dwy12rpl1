@extends('admin.layouts.app')

@section('content')

<style>
    .edit-book-page {
        padding: 24px;
        color: #33271f;
        font-family: Arial, Helvetica, sans-serif;
    }

    .edit-book-page * {
        box-sizing: border-box;
    }

    .edit-book-page .page-header {
        margin-bottom: 24px;
    }

    .edit-book-page .page-title {
        margin: 0;
        color: #6b3f28;
        font-size: 27px;
        font-weight: 800;
    }

    .edit-book-page .page-subtitle {
        margin-top: 7px;
        color: #81756d;
        font-size: 13px;
    }

    .edit-book-page .form-card {
        width: 100%;
        max-width: 850px;
        margin: 0 auto;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e8e1db;
        border-radius: 13px;
        box-shadow: 0 4px 15px rgba(69, 43, 26, .06);
    }

    .edit-book-page .form-card-header {
        padding: 22px 25px;
        border-bottom: 1px solid #eee7e1;
        background: #fff;
    }

    .edit-book-page .form-card-header h2 {
        margin: 0;
        color: #6b3f28;
        font-size: 19px;
        font-weight: 800;
    }

    .edit-book-page .form-card-header p {
        margin: 7px 0 0;
        color: #81756d;
        font-size: 12px;
    }

    .edit-book-page .form-body {
        padding: 25px;
    }

    .edit-book-page .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .edit-book-page .form-group {
        min-width: 0;
    }

    .edit-book-page .form-group.full-width {
        grid-column: 1 / -1;
    }

    .edit-book-page .form-label {
        display: block;
        margin-bottom: 8px;
        color: #51443b;
        font-size: 13px;
        font-weight: 700;
    }

    .edit-book-page .required {
        color: #dc3545;
    }

    .edit-book-page .form-control {
        display: block;
        width: 100%;
        min-height: 43px;
        padding: 10px 12px;
        border: 1px solid #d5d0ca;
        border-radius: 8px;
        background: #fff;
        color: #33271f;
        font-size: 13px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .edit-book-page .form-control:focus {
        border-color: #d96b24;
        box-shadow: 0 0 0 3px rgba(217, 107, 36, .12);
    }

    .edit-book-page select.form-control {
        cursor: pointer;
    }

    .edit-book-page .form-error {
        margin-top: 6px;
        color: #dc3545;
        font-size: 12px;
    }

    .edit-book-page .alert-error {
        margin-bottom: 20px;
        padding: 13px 15px;
        border: 1px solid #f1b9bd;
        border-radius: 8px;
        background: #fff0f1;
        color: #a5222b;
        font-size: 13px;
    }

    .edit-book-page .image-upload-box {
        padding: 18px;
        border: 2px dashed #d6c4b8;
        border-radius: 10px;
        background: #fcfaf8;
        transition: border-color .2s, background .2s;
    }

    .edit-book-page .image-upload-box:hover {
        border-color: #d96b24;
        background: #fff8f2;
    }

    .edit-book-page .image-preview {
        display: block;
        width: 100%;
        max-width: 260px;
        max-height: 320px;
        margin: 0 auto 12px;
        object-fit: contain;
        border: 1px solid #e8e1db;
        border-radius: 9px;
        background: #f7f4f1;
    }

    .edit-book-page .image-placeholder {
        width: 100%;
        max-width: 260px;
        min-height: 150px;
        margin: 0 auto 12px;
        padding: 24px 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-radius: 9px;
        background: #f7f4f1;
        color: #81756d;
        text-align: center;
        font-size: 12px;
    }

    .edit-book-page .image-actions {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 9px;
        margin-top: 12px;
    }

    .edit-book-page .image-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        min-height: 37px;
        padding: 9px 13px;
        border: 1px solid #d5d0ca;
        border-radius: 7px;
        background: #fff;
        color: #51443b;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s, color .2s;
    }

    .edit-book-page .image-btn:hover {
        background: #f4eee9;
    }

    .edit-book-page .image-btn-remove {
        border-color: #f1b9bd;
        color: #b4232c;
    }

    .edit-book-page .image-btn-remove:hover {
        background: #fff0f1;
    }

    .edit-book-page .image-help {
        margin-top: 10px;
        color: #81756d;
        font-size: 12px;
        line-height: 1.6;
    }

    .edit-book-page .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 27px;
        padding-top: 20px;
        border-top: 1px solid #eee7e1;
    }

    .edit-book-page .footer-actions {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 10px;
        margin-left: auto;
    }

    .edit-book-page .btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        min-height: 40px;
        padding: 10px 16px;
        border: 1px solid transparent;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .edit-book-page .btn:hover {
        transform: translateY(-1px);
    }

    .edit-book-page .btn-cancel {
        border-color: #d5d0ca;
        background: #fff;
        color: #51443b;
    }

    .edit-book-page .btn-cancel:hover {
        background: #f7f4f1;
    }

    .edit-book-page .btn-save {
        background: #6b3f28;
        color: #fff;
    }

    .edit-book-page .btn-save:hover {
        background: #4e2d1d;
    }

    .edit-book-page .btn-save:disabled {
        opacity: .7;
        cursor: wait;
        transform: none;
    }

    @media (max-width: 650px) {
        .edit-book-page {
            padding: 15px;
        }

        .edit-book-page .page-title {
            font-size: 23px;
        }

        .edit-book-page .form-body {
            padding: 18px;
        }

        .edit-book-page .form-grid {
            grid-template-columns: 1fr;
            gap: 17px;
        }

        .edit-book-page .form-group.full-width {
            grid-column: auto;
        }

        .edit-book-page .form-footer {
            align-items: stretch;
        }

        .edit-book-page .footer-actions {
            width: 100%;
        }

        .edit-book-page .footer-actions .btn {
            flex: 1;
        }
    }
</style>

<div class="edit-book-page">

    <header class="page-header">
        <h1 class="page-title">Edit Data Buku</h1>
        <p class="page-subtitle">
            Perbarui informasi buku perpustakaan SMKN 5 Kabupaten Tangerang.
        </p>
    </header>

    @if($errors->any())
        <div class="alert-error">
            <strong>Data belum berhasil disimpan.</strong>
            <ul style="margin: 8px 0 0 20px; list-style: disc;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="form-card">

        <div class="form-card-header">
            <h2>Informasi Buku</h2>
            <p>
                Ubah informasi dan gambar buku jika diperlukan, lalu klik Simpan Perubahan.
            </p>
        </div>

        <div class="form-body">

            <form id="editBookForm"
                  action="{{ route('books.update', $book->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="form-grid">

                    <!-- JUDUL -->
                    <div class="form-group full-width">
                        <label for="title" class="form-label">
                            Judul Buku <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title', $book->title) }}"
                            class="form-control"
                            placeholder="Masukkan judul buku"
                            maxlength="255"
                            required
                        >

                        @error('title')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- PENERBIT -->
                    <div class="form-group">
                        <label for="penerbit" class="form-label">
                            Penerbit <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="penerbit"
                            name="penerbit"
                            value="{{ old('penerbit', $book->penerbit) }}"
                            class="form-control"
                            placeholder="Nama penerbit"
                            maxlength="255"
                            required
                        >

                        @error('penerbit')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- PENGARANG -->
                    <div class="form-group">
                        <label for="pengarang" class="form-label">
                            Pengarang <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="pengarang"
                            name="pengarang"
                            value="{{ old('pengarang', $book->pengarang) }}"
                            class="form-control"
                            placeholder="Nama pengarang"
                            maxlength="255"
                            required
                        >

                        @error('pengarang')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- TAHUN TERBIT -->
                    <div class="form-group">
                        <label for="tahun_terbit" class="form-label">
                            Tahun Terbit <span class="required">*</span>
                        </label>

                        <input
                            type="number"
                            id="tahun_terbit"
                            name="tahun_terbit"
                            value="{{ old('tahun_terbit', $book->tahun_terbit) }}"
                            class="form-control"
                            placeholder="Contoh: 2024"
                            min="1000"
                            max="9999"
                            required
                        >

                        @error('tahun_terbit')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- TAHUN BANTUAN -->
                    <div class="form-group">
                        <label for="tahun_bantuan" class="form-label">
                            Tahun Bantuan <span class="required">*</span>
                        </label>

                        <input
                            type="number"
                            id="tahun_bantuan"
                            name="tahun_bantuan"
                            value="{{ old('tahun_bantuan', $book->tahun_bantuan) }}"
                            class="form-control"
                            placeholder="Contoh: 2025"
                            min="1000"
                            max="9999"
                            required
                        >

                        @error('tahun_bantuan')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- KATEGORI -->
                    <div class="form-group">
                        <label for="category_id" class="form-label">
                            Kategori <span class="required">*</span>
                        </label>

                        <select
                            id="category_id"
                            name="category_id"
                            class="form-control"
                            required
                        >
                            <option value="">-- Pilih Kategori --</option>

                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ (string) old('category_id', $book->category_id) === (string) $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name ?? $category->nama_kategori ?? 'Kategori #' . $category->id }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- STOK -->
                    <div class="form-group">
                        <label for="stock" class="form-label">
                            Stok Buku <span class="required">*</span>
                        </label>

                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            value="{{ old('stock', $book->stock) }}"
                            class="form-control"
                            placeholder="Jumlah stok"
                            min="0"
                            required
                        >

                        @error('stock')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- GAMBAR BUKU -->
                    <div class="form-group full-width">
                        <label for="image" class="form-label">
                            Gambar Sampul Buku
                            <span style="font-weight:400;color:#81756d;">
                                (Opsional)
                            </span>
                        </label>

                        <div class="image-upload-box">

                            <!-- GAMBAR SAAT INI / PREVIEW GAMBAR BARU -->
                            @if($book->image)
                                <img
                                    id="imagePreview"
                                    class="image-preview"
                                    src="{{ asset('storage/' . $book->image) }}"
                                    alt="Sampul {{ $book->title }}"
                                >

                                <div
                                    id="imagePlaceholder"
                                    class="image-placeholder"
                                    style="display:none;"
                                >
                                    <span>Belum ada gambar sampul.</span>
                                </div>
                            @else
                                <img
                                    id="imagePreview"
                                    class="image-preview"
                                    src=""
                                    alt="Preview gambar sampul"
                                    style="display:none;"
                                >

                                <div
                                    id="imagePlaceholder"
                                    class="image-placeholder"
                                >
                                    <svg width="38" height="38"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.5"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         aria-hidden="true">
                                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <path d="m21 15-5-5L5 21"/>
                                    </svg>
                                    <span>Belum ada gambar sampul.</span>
                                </div>
                            @endif

                            <p
                                id="imageFileName"
                                style="display:none;text-align:center;font-size:12px;color:#51443b;margin-top:8px;overflow-wrap:anywhere;"
                            ></p>

                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                class="form-control"
                                style="margin-top:12px;"
                            >

                            <div class="image-actions">
                                <button
                                    type="button"
                                    id="cancelNewImage"
                                    class="image-btn"
                                    style="display:none;"
                                >
                                    Batalkan Gambar Baru
                                </button>
                            </div>

                            <p class="image-help">
                                Pilih gambar baru jika ingin mengganti sampul buku.
                                Jika tidak memilih gambar, sampul lama akan tetap digunakan.
                                Format yang didukung: JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                            </p>
                        </div>

                        @error('image')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- TOMBOL FORM -->
                <div class="form-footer">
                    <span style="color:#8a7c70;font-size:11px;">
                        <span class="required">*</span> Wajib diisi
                    </span>

                    <div class="footer-actions">

                        <a href="{{ route('books.index') }}" class="btn btn-cancel">
                            Batal
                        </a>

                        <button type="submit" id="saveBookBtn" class="btn btn-save">
                            <svg width="16" height="16" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" aria-hidden="true">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"/>
                                <path d="M17 21v-8H7v8"/>
                                <path d="M7 3v5h8"/>
                            </svg>
                            Simpan Perubahan
                        </button>

                    </div>
                </div>

            </form>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('editBookForm');
    const saveButton = document.getElementById('saveBookBtn');

    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const imagePlaceholder = document.getElementById('imagePlaceholder');
    const imageFileName = document.getElementById('imageFileName');
    const cancelNewImage = document.getElementById('cancelNewImage');

    // Simpan gambar awal agar dapat dikembalikan jika pilihan dibatalkan.
    const originalImageSrc = imagePreview ? imagePreview.getAttribute('src') : '';
    const originalImageVisible = Boolean(originalImageSrc);

    let previewUrl = null;

    function showOriginalImage() {
        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

        if (imageInput) {
            imageInput.value = '';
        }

        if (imagePreview) {
            if (originalImageVisible) {
                imagePreview.src = originalImageSrc;
                imagePreview.style.display = 'block';
            } else {
                imagePreview.removeAttribute('src');
                imagePreview.style.display = 'none';
            }
        }

        if (imagePlaceholder) {
            imagePlaceholder.style.display =
                originalImageVisible ? 'none' : 'flex';
        }

        if (imageFileName) {
            imageFileName.textContent = '';
            imageFileName.style.display = 'none';
        }

        if (cancelNewImage) {
            cancelNewImage.style.display = 'none';
        }
    }

    // PREVIEW GAMBAR PENGGANTI
    imageInput?.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (!file) {
            showOriginalImage();
            return;
        }

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {
            alert('Format gambar harus JPG, JPEG, PNG, atau WEBP.');
            showOriginalImage();
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran gambar maksimal 2 MB.');
            showOriginalImage();
            return;
        }

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
        }

        previewUrl = URL.createObjectURL(file);

        imagePreview.src = previewUrl;
        imagePreview.style.display = 'block';

        if (imagePlaceholder) {
            imagePlaceholder.style.display = 'none';
        }

        if (imageFileName) {
            imageFileName.textContent = 'Gambar baru: ' + file.name;
            imageFileName.style.display = 'block';
        }

        if (cancelNewImage) {
            cancelNewImage.style.display = 'inline-flex';
        }
    });

    // BATALKAN PILIHAN GAMBAR BARU
    cancelNewImage?.addEventListener('click', function () {
        showOriginalImage();
    });

    // CEGAH PENGIRIMAN GANDA
    form?.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            return;
        }

        if (saveButton.disabled) {
            event.preventDefault();
            return;
        }

        saveButton.disabled = true;
        saveButton.textContent = 'Menyimpan...';
    });

    // Bersihkan URL preview sementara.
    window.addEventListener('beforeunload', function () {
        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
        }
    });
});
</script>

@endsection