 @extends('admin.layouts.app')

@section('title', 'Trash Buku - Book Stock SMKN 5')

@section('content')
<div class="trash-page">
    <style>
        .trash-page {
            --trash-brown: #63391f;
            --trash-orange: #c87532;
            --trash-bg: #f8f5f2;
            --trash-text: #493a30;
            --trash-muted: #85786e;
            --trash-border: #eee7e1;

            color: var(--trash-text);
            padding: 22px;
            font-family: inherit;
        }

        .trash-page *,
        .trash-page *::before,
        .trash-page *::after {
            box-sizing: border-box;
        }

        .trash-page .trash-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }

        .trash-page .heading-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .trash-page .heading-icon {
            width: 54px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 13px;
            background: #f2e3d6;
            color: var(--trash-orange);
        }

        .trash-page .heading-icon svg {
            width: 27px;
            height: 27px;
        }

        .trash-page .heading-divider {
            width: 1px;
            height: 49px;
            background: #dfd3c8;
        }

        .trash-page .heading-title {
            margin: 0 0 6px;
            color: var(--trash-brown);
            font-size: 27px;
            font-weight: 750;
            letter-spacing: -.5px;
        }

        .trash-page .heading-description {
            margin: 0;
            color: var(--trash-muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .trash-page .trash-btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            min-height: 42px;
            padding: 10px 16px;
            border: 1px solid transparent;
            border-radius: 11px;
            text-decoration: none;
            font-family: inherit;
            font-size: 12px;
            font-weight: 650;
            cursor: pointer;
            transition: background .2s, border-color .2s, transform .2s;
            white-space: nowrap;
        }

        .trash-page .trash-btn:hover {
            transform: translateY(-1px);
        }

        .trash-page .trash-btn svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .trash-page .btn-back {
            color: var(--trash-brown);
            background: #f1e9e2;
        }

        .trash-page .btn-back:hover {
            background: #e9ddd2;
        }

        .trash-page .btn-empty {
            color: #b9382e;
            background: #fff0ee;
        }

        .trash-page .btn-empty:hover {
            background: #ffe3df;
        }

        .trash-page .btn-restore {
            color: #287348;
            background: #eaf6ed;
            border-color: #d6eadb;
        }

        .trash-page .btn-restore:hover {
            background: #d9efdf;
        }

        .trash-page .btn-delete {
            color: #b9382e;
            background: #fff0ee;
            border-color: #f5dcd8;
        }

        .trash-page .btn-delete:hover {
            background: #ffe3df;
        }

        .trash-page .trash-info {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 20px 22px;
            margin-bottom: 24px;
            border: 1px solid #f0ddc9;
            border-radius: 14px;
            background: #fff9f2;
        }

        .trash-page .info-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 39px;
            height: 39px;
            flex-shrink: 0;
            border-radius: 50%;
            color: white;
            background: var(--trash-orange);
        }

        .trash-page .info-icon svg {
            width: 20px;
            height: 20px;
        }

        .trash-page .info-content {
            padding-left: 15px;
            border-left: 2px solid #e9b47d;
        }

        .trash-page .info-content strong {
            display: block;
            margin: 0 0 6px;
            color: var(--trash-brown);
            font-size: 15px;
            font-weight: 750;
        }

        .trash-page .info-content p {
            margin: 0;
            color: #79695d;
            font-size: 13px;
            line-height: 1.7;
        }

        .trash-page .stat-card {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 24px;
            margin-bottom: 28px;
            background: #fff;
            border: 1px solid var(--trash-border);
            border-radius: 14px;
            box-shadow: 0 5px 18px rgba(71, 43, 25, .035);
        }

        .trash-page .stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            flex-shrink: 0;
            border-radius: 50%;
            color: #b95b25;
            background: #f9eee5;
        }

        .trash-page .stat-icon svg {
            width: 30px;
            height: 30px;
        }

        .trash-page .stat-label {
            margin-bottom: 7px;
            color: var(--trash-muted);
            font-size: 13px;
        }

        .trash-page .stat-number {
            color: var(--trash-brown);
            font-size: 31px;
            font-weight: 800;
            line-height: 1;
        }

        .trash-page .table-card {
            overflow: hidden;
            background: #fff;
            border: 1px solid var(--trash-border);
            border-radius: 14px;
            box-shadow: 0 5px 18px rgba(71, 43, 25, .035);
        }

        .trash-page .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
            padding: 23px 25px;
            border-bottom: 1px solid var(--trash-border);
        }

        .trash-page .table-heading-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .trash-page .table-heading-icon {
            color: var(--trash-brown);
        }

        .trash-page .table-heading-icon svg {
            display: block;
            width: 26px;
            height: 26px;
        }

        .trash-page .table-title {
            margin: 0 0 6px;
            color: var(--trash-brown);
            font-size: 18px;
            font-weight: 750;
        }

        .trash-page .table-subtitle {
            margin: 0;
            color: var(--trash-muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .trash-page .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .trash-page table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        .trash-page thead {
            background: #fbf8f5;
        }

        .trash-page th {
            padding: 15px 18px;
            color: #796454;
            font-size: 11px;
            font-weight: 750;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: .45px;
            white-space: nowrap;
        }

        .trash-page td {
            padding: 17px 18px;
            border-top: 1px solid #f1ebe6;
            color: #514239;
            font-size: 13px;
            vertical-align: middle;
        }

        .trash-page tbody tr {
            transition: background .15s;
        }

        .trash-page tbody tr:hover {
            background: #fdfaf7;
        }

        .trash-page .book-title {
            color: var(--trash-brown);
            font-weight: 750;
            line-height: 1.5;
        }

        .trash-page .book-meta {
            margin-top: 5px;
            color: var(--trash-muted);
            font-size: 12px;
        }

        .trash-page .deleted-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 20px;
            color: #b9382e;
            background: #fff0ee;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .trash-page .deleted-badge span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #d64d42;
        }

        .trash-page .action-group {
            display: flex;
            align-items: center;
            gap: 7px;
            flex-wrap: wrap;
        }

        .trash-page .empty-state {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-height: 350px;
            padding: 45px 22px;
            text-align: center;
        }

        .trash-page .empty-illustration {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 122px;
            height: 122px;
            margin-bottom: 19px;
            border-radius: 50%;
            color: #9b8069;
            background: #faf6f2;
        }

        .trash-page .empty-illustration svg {
            width: 57px;
            height: 57px;
        }

        .trash-page .empty-state h3 {
            margin: 0 0 10px;
            color: var(--trash-brown);
            font-size: 21px;
            font-weight: 750;
        }

        .trash-page .empty-state p {
            margin: 0;
            color: var(--trash-muted);
            font-size: 13px;
            line-height: 1.8;
        }

        .trash-page .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 16px;
            margin-bottom: 18px;
            border-radius: 11px;
            font-size: 13px;
            line-height: 1.6;
        }

        .trash-page .alert-success {
            color: #216b3c;
            background: #edf8f0;
            border: 1px solid #d2ead9;
        }

        .trash-page .alert-error {
            color: #9f2929;
            background: #fff1f0;
            border: 1px solid #f1d4d1;
        }

        .trash-page form {
            margin: 0;
        }

        @media (min-width: 1200px) {
            .trash-page {
                padding: 26px;
            }
        }

        @media (max-width: 640px) {
            .trash-page {
                padding: 15px;
            }

            .trash-page .heading-left {
                gap: 10px;
            }

            .trash-page .heading-icon {
                width: 43px;
                height: 43px;
            }

            .trash-page .heading-divider {
                height: 40px;
            }

            .trash-page .heading-title {
                font-size: 21px;
            }

            .trash-page .heading-description {
                font-size: 12px;
            }

            .trash-page .trash-heading > .trash-btn {
                width: 100%;
            }

            .trash-page .trash-info {
                gap: 11px;
                padding: 16px;
            }

            .trash-page .info-content {
                padding-left: 11px;
            }

            .trash-page .stat-card {
                padding: 18px;
                gap: 15px;
            }

            .trash-page .stat-icon {
                width: 52px;
                height: 52px;
            }

            .trash-page .table-header {
                padding: 18px;
            }

            .trash-page .table-title {
                font-size: 16px;
            }

            .trash-page .table-header > form,
            .trash-page .table-header > form .trash-btn {
                width: 100%;
            }

            .trash-page .empty-state {
                min-height: 280px;
                padding: 35px 18px;
            }

            .trash-page .empty-illustration {
                width: 95px;
                height: 95px;
            }

            .trash-page .empty-illustration svg {
                width: 45px;
                height: 45px;
            }

            .trash-page .empty-state h3 {
                font-size: 18px;
            }
        }
    </style>

    {{-- HEADER --}}
    <div class="trash-heading">
        <div class="heading-left">
            <div class="heading-icon">
                <svg viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round"
                     aria-hidden="true">
                    <path d="M3 6h18"/>
                    <path d="M8 6V4h8v2"/>
                    <path d="m19 6-1 14H6L5 6"/>
                    <path d="M10 10v6M14 10v6"/>
                </svg>
            </div>

            <div class="heading-divider"></div>

            <div>
                <h1 class="heading-title">Trash Buku</h1>
                <p class="heading-description">
                    Kelola buku yang sudah dihapus dari daftar buku.
                </p>
            </div>
        </div>

        <a href="{{ route('books.index') }}" class="trash-btn btn-back">
            <svg viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.8"
                 stroke-linecap="round" stroke-linejoin="round"
                 aria-hidden="true">
                <path d="m12 19-7-7 7-7"/>
                <path d="M5 12h14"/>
            </svg>
            Kembali ke Data Buku
        </a>
    </div>

    {{-- NOTIFIKASI --}}
    @if (session('success'))
        <div class="alert alert-success" role="status">
            <strong>✓</strong>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error" role="alert">
            <strong>!</strong>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error" role="alert">
            <strong>!</strong>
            <div>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- INFORMASI TRASH --}}
    <div class="trash-info">
        <div class="info-icon">
            <svg viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round"
                 aria-hidden="true">
                <circle cx="12" cy="12" r="10"/>
                <path d="M12 11v5"/>
                <path d="M12 7h.01"/>
            </svg>
        </div>

        <div class="info-content">
            <strong>Informasi Trash</strong>
            <p>
                Buku di sini sudah dihapus sementara. Kamu bisa memulihkannya
                agar kembali ke Data Buku, atau menghapusnya secara permanen.
                Penghapusan permanen tidak dapat dibatalkan.
            </p>
        </div>
    </div>

    {{-- TOTAL BUKU --}}
    <div class="stat-card">
        <div class="stat-icon">
            <svg viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.8"
                 stroke-linecap="round" stroke-linejoin="round"
                 aria-hidden="true">
                <path d="M4 7h16"/>
                <path d="M10 11v6M14 11v6"/>
                <path d="m5 7 1 14h12l1-14"/>
                <path d="M9 7V4h6v3"/>
            </svg>
        </div>

        <div>
            <div class="stat-label">Total buku di Trash</div>
            <div class="stat-number">{{ $books->count() }}</div>
        </div>
    </div>

    {{-- DAFTAR BUKU TERHAPUS --}}
    <div class="table-card">
        <div class="table-header">
            <div class="table-heading-left">
                <div class="table-heading-icon">
                    <svg viewBox="0 0 24 24" fill="currentColor"
                         aria-hidden="true">
                        <path d="M3 5.5A2.5 2.5 0 0 1 5.5 3H10a2 2 0 0 1 2 2v16a1 1 0 0 0-1-1H5.5A2.5 2.5 0 0 0 3 22V5.5Z"/>
                        <path d="M21 5.5A2.5 2.5 0 0 0 18.5 3H14a2 2 0 0 0-2 2v16a1 1 0 0 1 1-1h5.5a2.5 2.5 0 0 1 2.5 2V5.5Z"/>
                    </svg>
                </div>

                <div>
                    <h2 class="table-title">Daftar Buku Terhapus</h2>
                    <p class="table-subtitle">
                        Buku yang dihapus sementara akan muncul di sini.
                    </p>
                </div>
            </div>

            @if ($books->count() > 0)
                <form
                    action="{{ route('books.emptyTrash') }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus PERMANEN semua buku di Trash? Tindakan ini tidak dapat dibatalkan.');"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="trash-btn btn-empty">
                        <svg viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="1.8"
                             stroke-linecap="round" stroke-linejoin="round"
                             aria-hidden="true">
                            <path d="M3 6h18"/>
                            <path d="M8 6V4h8v2"/>
                            <path d="m19 6-1 14H6L5 6"/>
                            <path d="M10 10v6M14 10v6"/>
                        </svg>
                        Kosongkan Trash
                    </button>
                </form>
            @endif
        </div>

        <div class="table-wrap">
            @if ($books->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Informasi Buku</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Dihapus Pada</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <div class="book-title">
                                        {{ $book->title }}
                                    </div>

                                    <div class="book-meta">
                                        Pengarang:
                                        {{ $book->pengarang ?: '-' }}
                                    </div>

                                    <div class="book-meta">
                                        Penerbit:
                                        {{ $book->penerbit ?: '-' }}
                                    </div>
                                </td>

                                <td>
                                    {{ $book->category->name ?? '-' }}
                                </td>

                                <td>{{ $book->stock }}</td>

                                <td>
                                    {{ $book->deleted_at
                                        ? $book->deleted_at->format('d-m-Y H:i')
                                        : '-' }}
                                </td>

                                <td>
                                    <span class="deleted-badge">
                                        <span></span>
                                        Dihapus
                                    </span>
                                </td>

                                <td>
                                    <div class="action-group">
                                        <form
                                            action="{{ route('books.restore', $book->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Pulihkan buku ini ke Data Buku?');"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="trash-btn btn-restore">
                                                <svg viewBox="0 0 24 24" fill="none"
                                                     stroke="currentColor" stroke-width="1.8"
                                                     stroke-linecap="round" stroke-linejoin="round"
                                                     aria-hidden="true">
                                                    <path d="M3 12a9 9 0 1 0 3-6.7L3 8"/>
                                                    <path d="M3 3v5h5"/>
                                                </svg>
                                                Pulihkan
                                            </button>
                                        </form>

                                        <form
                                            action="{{ route('books.forceDelete', $book->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Hapus buku ini secara PERMANEN? Data tidak dapat dikembalikan.');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="trash-btn btn-delete">
                                                <svg viewBox="0 0 24 24" fill="none"
                                                     stroke="currentColor" stroke-width="1.8"
                                                     stroke-linecap="round" stroke-linejoin="round"
                                                     aria-hidden="true">
                                                    <path d="M3 6h18"/>
                                                    <path d="M8 6V4h8v2"/>
                                                    <path d="m19 6-1 14H6L5 6"/>
                                                    <path d="M10 10v6M14 10v6"/>
                                                </svg>
                                                Hapus Permanen
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div class="empty-illustration">
                        <svg viewBox="0 0 64 64" fill="none"
                             stroke="currentColor" stroke-width="3.5"
                             stroke-linecap="round" stroke-linejoin="round"
                             aria-hidden="true">
                            <path d="M13 17h38"/>
                            <path d="M23 17V10h18v7"/>
                            <path d="m17 17 3 36h24l3-36"/>
                            <path d="M27 25v18M37 25v18"/>
                            <path d="M8 17h48"/>
                        </svg>
                    </div>

                    <h3>Trash masih kosong</h3>

                    <p>
                        Belum ada buku yang dihapus sementara.<br>
                        Buku yang dihapus nanti akan muncul di sini.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection