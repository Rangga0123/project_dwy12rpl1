@extends('layouts.app')

@section('title', 'Pengajuan Restock')

@push('styles')
<style>
    .restock-page {
        max-width: 1000px;
        margin: 0 auto;
        padding: 30px;
    }

    .restock-header {
        margin-bottom: 25px;
    }

    .restock-header h1 {
        margin: 0 0 8px;
        color: #70432d;
        font-size: 30px;
        font-weight: 700;
    }

    .restock-header p {
        margin: 0;
        color: #78716c;
        font-size: 14px;
        line-height: 1.6;
    }

    .restock-card {
        padding: 30px;
        background: #fff;
        border: 1px solid #e9e1db;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(60, 35, 20, 0.06);
    }

    .restock-success {
        margin-bottom: 20px;
        padding: 14px 18px;
        color: #18733c;
        background: #e8f8ee;
        border: 1px solid #a8dfbc;
        border-radius: 10px;
        line-height: 1.6;
    }

    .restock-errors {
        margin-bottom: 20px;
        padding: 14px 18px;
        color: #b42318;
        background: #fff0f0;
        border: 1px solid #f0b8b8;
        border-radius: 10px;
    }

    .restock-errors ul {
        margin: 8px 0 0;
        padding-left: 20px;
        list-style: disc;
    }

    .restock-group {
        margin-bottom: 22px;
    }

    .restock-group label {
        display: block;
        margin-bottom: 9px;
        color: #44403c;
        font-size: 14px;
        font-weight: 700;
    }

    .restock-control {
        display: block;
        width: 100%;
        padding: 13px 15px;
        color: #292524;
        background: #fff;
        border: 1px solid #d6cec7;
        border-radius: 9px;
        outline: none;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        transition: border-color .2s, box-shadow .2s;
    }

    .restock-control:focus {
        border-color: #d96b24;
        box-shadow: 0 0 0 3px rgba(217, 107, 36, .13);
    }

    .restock-group select {
        cursor: pointer;
    }

    .restock-group textarea {
        min-height: 120px;
        resize: vertical;
        line-height: 1.6;
    }

    .restock-help {
        margin-top: 7px;
        color: #78716c;
        font-size: 12px;
        line-height: 1.5;
    }

    .restock-error {
        margin-top: 7px;
        color: #c62828;
        font-size: 13px;
    }

    .restock-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        margin-top: 5px;
    }

    .restock-submit {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 13px 23px;
        color: #fff;
        background: #d96b24;
        border: none;
        border-radius: 9px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .restock-submit:hover {
        background: #c45b1b;
        transform: translateY(-1px);
    }

    .restock-back {
        display: inline-block;
        margin-top: 22px;
        color: #70432d;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
    }

    .restock-back:hover {
        color: #d96b24;
        text-decoration: underline;
    }

    @media (max-width: 1023px) {
        .restock-page {
            padding: 24px 18px;
        }
    }

    @media (max-width: 600px) {
        .restock-page {
            padding: 20px 15px;
        }

        .restock-header h1 {
            font-size: 25px;
        }

        .restock-card {
            padding: 20px 16px;
            border-radius: 12px;
        }

        .restock-submit {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')

<div class="restock-page">

    {{-- HEADER HALAMAN --}}
    <div class="restock-header">
        <h1>Pengajuan Restock</h1>
        <p>Ajukan penambahan stok buku perpustakaan SMKN 5.</p>
    </div>

    {{-- NOTIFIKASI BERHASIL --}}
    @if (session('success'))
        <div class="restock-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    {{-- NOTIFIKASI VALIDASI --}}
    @if ($errors->any())
        <div class="restock-errors">
            <strong>Pengajuan belum dapat dikirim.</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM PENGAJUAN --}}
    <div class="restock-card">

        <form
            action="{{ route('user.restock.store') }}"
            method="POST"
        >
            @csrf

            {{-- PILIH BUKU --}}
            <div class="restock-group">
                <label for="book_id">Pilih Buku</label>

                <select
                    name="book_id"
                    id="book_id"
                    class="restock-control"
                    required
                >
                    <option value="">-- Pilih Buku --</option>

                    @forelse ($books as $book)
                        <option
                            value="{{ $book->id }}"
                            {{ (string) old('book_id') === (string) $book->id ? 'selected' : '' }}
                        >
                            {{ $book->title }}
                            — Stok saat ini: {{ $book->stock }}
                        </option>
                    @empty
                        <option value="" disabled>
                            Belum ada data buku
                        </option>
                    @endforelse
                </select>

                @error('book_id')
                    <div class="restock-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- JUMLAH RESTOCK --}}
            <div class="restock-group">
                <label for="jumlah">Jumlah Restock</label>

                <input
                    type="number"
                    name="jumlah"
                    id="jumlah"
                    class="restock-control"
                    min="1"
                    step="1"
                    value="{{ old('jumlah') }}"
                    placeholder="Masukkan jumlah buku"
                    required
                >

                <div class="restock-help">
                    Masukkan jumlah buku yang ingin diajukan.
                </div>

                @error('jumlah')
                    <div class="restock-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- ALASAN PENGAJUAN --}}
            <div class="restock-group">
                <label for="alasan">Alasan Pengajuan</label>

                <textarea
                    name="alasan"
                    id="alasan"
                    class="restock-control"
                    maxlength="1000"
                    placeholder="Contoh: Stok buku sudah hampir habis."
                >{{ old('alasan') }}</textarea>

                @error('alasan')
                    <div class="restock-error">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- TOMBOL --}}
            <div class="restock-actions">
                <button type="submit" class="restock-submit">
                    <span>✓</span>
                    <span>Kirim Pengajuan</span>
                </button>
            </div>

        </form>

    </div>

    {{-- KEMBALI KE DASHBOARD --}}
    <a href="{{ route('dashboard') }}" class="restock-back">
        ← Kembali ke Dashboard
    </a>

</div>

@endsection