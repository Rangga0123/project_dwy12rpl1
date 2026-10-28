@extends('admin.layouts.app')

@section('title', 'Pengajuan Restock')
@section('subtitle', 'Kelola permintaan penambahan stok buku')

@push('styles')
<style>
    .restock-page {
        --brown: #6b3f28;
        --brown-dark: #4f2d1d;
        --orange: #d96b24;
        --muted: #81756d;
        color: #33271f;
    }

    .restock-page * {
        box-sizing: border-box;
    }

    .restock-page .form-control {
        width: 100%;
        min-width: 0;
        padding: 10px 12px;
        border: 1px solid #d5d0ca;
        border-radius: 7px;
        outline: none;
        background: #fff;
        color: #392a20;
        font-size: 12px;
        transition: border-color .2s, box-shadow .2s;
    }

    .restock-page .form-control:focus {
        border-color: var(--orange);
        box-shadow: 0 0 0 3px rgba(217, 107, 36, .12);
    }

    .restock-page textarea.form-control {
        min-height: 62px;
        resize: vertical;
    }

    .restock-page .status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .restock-page .status-menunggu {
        background: #fff2cc;
        color: #92400e;
    }

    .restock-page .status-disetujui {
        background: #dcfce7;
        color: #166534;
    }

    .restock-page .status-ditolak {
        background: #fee2e2;
        color: #991b1b;
    }

    .restock-page .status-lain {
        background: #f3f4f6;
        color: #4b5563;
    }

    .restock-page .request-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        gap: 6px;
        padding: 9px 11px;
        border: 1px solid transparent;
        border-radius: 6px;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s;
    }

    .restock-page .btn-approve {
        background: #198754;
    }

    .restock-page .btn-approve:hover {
        background: #146c43;
    }

    .restock-page .btn-reject {
        background: #dc3545;
    }

    .restock-page .btn-reject:hover {
        background: #bb2d3b;
    }

    .restock-page .request-table-card {
        overflow: hidden;
        border: 1px solid #e5ddd6;
        border-radius: 11px;
        background: #fff;
        box-shadow: 0 4px 15px rgba(69, 43, 26, .05);
    }

    .restock-page .table-scroll {
        width: 100%;
        overflow-x: auto;
    }

    .restock-page .request-table {
        width: 100%;
        min-width: 1120px;
        border-collapse: collapse;
        border: 1px solid #d5d0ca;
        background: #fff;
        font-size: 12px;
    }

    .restock-page .request-table th,
    .restock-page .request-table td {
        padding: 13px 12px;
        border: 1px solid #d5d0ca;
        text-align: left;
        vertical-align: top;
        overflow-wrap: anywhere;
    }

    .restock-page .request-table thead th {
        background: #f4e9df;
        color: var(--brown);
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
        vertical-align: middle;
    }

    .restock-page .request-table tbody tr:nth-child(even) {
        background: #fcf6f0;
    }

    .restock-page .request-table tbody tr:nth-child(odd) {
        background: #fff;
    }

    .restock-page .request-table tbody tr:hover {
        background: #fff0e5;
    }

    .restock-page .request-table tbody tr[hidden] {
        display: none !important;
    }

    .restock-page .request-table .text-center {
        text-align: center;
    }

    .restock-page .request-table .user-name,
    .restock-page .request-table .book-name {
        color: #392a20;
        font-weight: 700;
    }

    .restock-page .request-table .sub-text {
        margin-top: 5px;
        color: #91857b;
        font-size: 10px;
    }

    .restock-page .quantity-badge {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        min-width: 48px;
        padding: 5px 9px;
        border-radius: 6px;
        background: #f4eee9;
        color: var(--brown);
        font-size: 11px;
        font-weight: 800;
    }

    .restock-page .action-cell {
        min-width: 220px;
    }

    .restock-page .processed-box {
        min-width: 180px;
        padding: 11px;
        border: 1px solid #e0e3e7;
        border-radius: 7px;
        background: #f8f9fa;
    }

    .restock-page .processed-box strong {
        display: block;
        color: #51443b;
        font-size: 11px;
    }

    .restock-page .processed-box span {
        display: block;
        margin-top: 5px;
        color: #928b84;
        font-size: 10px;
    }

    .restock-page .pagination-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        padding: 16px 18px;
        border-top: 1px solid #e5ddd6;
        background: #fff;
    }

    .restock-page .pagination-text {
        color: #81756d;
        font-size: 11px;
    }

    .restock-page .pagination {
        display: flex;
        align-items: center;
        gap: 0;
    }

    .restock-page .page-button {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        min-width: 36px;
        height: 35px;
        padding: 0 11px;
        border: 1px solid #ded8d2;
        border-right: 0;
        background: #fff;
        color: var(--brown);
        font-size: 12px;
        cursor: pointer;
        transition: background .15s, color .15s;
    }

    .restock-page .page-button:first-child {
        border-radius: 5px 0 0 5px;
    }

    .restock-page .page-button:last-child {
        border-right: 1px solid #ded8d2;
        border-radius: 0 5px 5px 0;
    }

    .restock-page .page-button:hover:not(:disabled):not(.active) {
        background: #fff0e5;
    }

    .restock-page .page-button.active {
        border-color: #0d6efd;
        background: #0d6efd;
        color: #fff;
    }

    .restock-page .page-button:disabled {
        opacity: .5;
        cursor: not-allowed;
    }

    .restock-page .request-row[hidden],
    .restock-page #noSearchResult[hidden],
    .restock-page #emptyDataRow[hidden] {
        display: none !important;
    }

    .restock-page .stat-card {
        border: 1px solid #e5ddd6;
        box-shadow: 0 3px 12px rgba(69, 43, 26, .04);
    }

    .restock-page .table-count {
        color: var(--brown);
        font-weight: 800;
    }

    @media (max-width: 640px) {
        .restock-page .pagination-footer {
            align-items: flex-start;
        }

        .restock-page .pagination {
            max-width: 100%;
            flex-wrap: wrap;
        }

        .restock-page .page-button {
            min-width: 33px;
            padding: 0 9px;
        }
    }
</style>
@endpush

@section('content')
<section class="restock-page page-content p-4 md:p-8 page-enter">

    {{-- HEADER --}}
    <div class="mb-7">
        <p class="mb-2 text-sm text-gray-500">Dashboard / Pengajuan Restock</p>
        <h1 class="text-2xl font-bold brown">Pengajuan Restock Buku</h1>
        <p class="mt-2 text-sm text-gray-500">
            Periksa, setujui, atau tolak permintaan restock dari pengguna.
        </p>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            <p class="mb-2 font-semibold">Periksa kembali data berikut:</p>
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- STATISTIK --}}
    <div class="mb-7 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
        <div class="stat-card rounded-xl border bg-white p-5">
            <p class="text-sm text-gray-500">Total Pengajuan</p>
            <h3 class="brown mt-3 text-3xl font-bold">
                {{ $requests->count() }}
            </h3>
            <p class="mt-1 text-xs text-gray-400">Semua permintaan</p>
        </div>

        <div class="stat-card rounded-xl border bg-white p-5">
            <p class="text-sm text-gray-500">Menunggu</p>
            <h3 class="mt-3 text-3xl font-bold text-yellow-700">
                {{ $requests->where('status', 'menunggu')->count() }}
            </h3>
            <p class="mt-1 text-xs text-gray-400">Perlu diperiksa</p>
        </div>

        <div class="stat-card rounded-xl border bg-white p-5">
            <p class="text-sm text-gray-500">Disetujui</p>
            <h3 class="mt-3 text-3xl font-bold text-green-700">
                {{ $requests->where('status', 'disetujui')->count() }}
            </h3>
            <p class="mt-1 text-xs text-gray-400">Pengajuan diterima</p>
        </div>

        <div class="stat-card rounded-xl border bg-white p-5">
            <p class="text-sm text-gray-500">Ditolak</p>
            <h3 class="mt-3 text-3xl font-bold text-red-700">
                {{ $requests->where('status', 'ditolak')->count() }}
            </h3>
            <p class="mt-1 text-xs text-gray-400">Pengajuan ditolak</p>
        </div>
    </div>

    {{-- TABEL PENGAJUAN --}}
    <div class="request-table-card">

        <div class="flex flex-col gap-4 border-b border-gray-200 p-5 md:flex-row md:items-center md:justify-between md:p-6">
            <div>
                <h3 class="text-lg font-bold brown">Daftar Pengajuan</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Data permintaan restock buku dari pengguna.
                </p>
            </div>

            <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">
                <input
                    type="search"
                    id="searchInput"
                    placeholder="Cari nama atau judul buku..."
                    class="form-control sm:w-64"
                    aria-label="Cari pengajuan"
                >

                <select id="statusFilter" class="form-control sm:w-40" aria-label="Filter status">
                    <option value="">Semua Status</option>
                    <option value="menunggu">Menunggu</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>
        </div>

        <div class="table-scroll">
            <table class="request-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width:55px;">No.</th>
                        <th style="min-width:130px;">Pengguna</th>
                        <th style="min-width:150px;">Buku</th>
                        <th class="text-center" style="min-width:85px;">Jumlah</th>
                        <th style="min-width:150px;">Alasan</th>
                        <th style="min-width:115px;">Status</th>
                        <th style="min-width:170px;">Catatan Admin</th>
                        <th style="min-width:230px;">Tindakan</th>
                    </tr>
                </thead>

                <tbody id="requestTableBody">
                    @forelse($requests as $item)
                        <tr
                            class="request-row"
                            data-search="{{ mb_strtolower(($item->user->name ?? 'pengguna') . ' ' . ($item->book->title ?? 'buku') . ' ' . ($item->alasan ?? '') . ' ' . ($item->catatan_admin ?? ''), 'UTF-8') }}"
                            data-status="{{ strtolower($item->status ?? '') }}"
                        >
                            <td class="text-center request-number">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <p class="user-name">
                                    {{ $item->user->name ?? 'Pengguna tidak ditemukan' }}
                                </p>
                                <p class="sub-text">ID: {{ $item->user_id ?? '-' }}</p>
                            </td>

                            <td>
                                <p class="book-name">
                                    {{ $item->book->title ?? 'Buku tidak ditemukan' }}
                                </p>
                            </td>

                            <td class="text-center">
                                <span class="quantity-badge">
                                    {{ $item->jumlah }}
                                </span>
                            </td>

                            <td>
                                <span class="text-gray-600">
                                    {{ $item->alasan ?: 'Tidak ada alasan' }}
                                </span>
                            </td>

                            <td>
                                @if($item->status === 'menunggu')
                                    <span class="status status-menunggu">Menunggu</span>
                                @elseif($item->status === 'disetujui')
                                    <span class="status status-disetujui">Disetujui</span>
                                @elseif($item->status === 'ditolak')
                                    <span class="status status-ditolak">Ditolak</span>
                                @else
                                    <span class="status status-lain">
                                        {{ ucfirst($item->status ?? 'Tidak diketahui') }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                <span class="text-gray-600">
                                    {{ $item->catatan_admin ?: '—' }}
                                </span>
                            </td>

                            <td class="action-cell">
                                @if($item->status === 'menunggu')
                                    <form
                                        method="POST"
                                        action="{{ route('admin.restock.approve', $item->id) }}"
                                        class="mb-3"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <label class="mb-1 block text-xs text-gray-500">
                                            Catatan persetujuan (opsional)
                                        </label>

                                        <textarea
                                            name="catatan_admin"
                                            rows="2"
                                            maxlength="1000"
                                            class="form-control mb-2"
                                            placeholder="Catatan untuk pengguna..."
                                        ></textarea>

                                        <button
                                            type="submit"
                                            class="request-btn btn-approve"
                                            onclick="return confirm('Yakin ingin menyetujui pengajuan ini?')"
                                        >
                                            ✓ Setujui Pengajuan
                                        </button>
                                    </form>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.restock.reject', $item->id) }}"
                                        class="border-t border-gray-200 pt-3"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <label class="mb-1 block text-xs text-gray-500">
                                            Alasan penolakan (wajib)
                                        </label>

                                        <textarea
                                            name="catatan_admin"
                                            rows="2"
                                            maxlength="1000"
                                            required
                                            class="form-control mb-2"
                                            placeholder="Tuliskan alasan penolakan..."
                                        ></textarea>

                                        <button
                                            type="submit"
                                            class="request-btn btn-reject"
                                            onclick="return confirm('Yakin ingin menolak pengajuan ini?')"
                                        >
                                            ✕ Tolak Pengajuan
                                        </button>
                                    </form>
                                @else
                                    <div class="processed-box">
                                        <strong>Pengajuan sudah diproses</strong>
                                        <span>Tindakan tidak tersedia lagi.</span>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyDataRow">
                            <td colspan="8" class="px-6 py-14 text-center">
                                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-[#f4eee9] brown">
                                    <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l3 3v15H6V3zM9 12h6M9 15h6"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-700">Belum Ada Pengajuan</h4>
                                <p class="mt-2 text-sm text-gray-500">
                                    Pengajuan restock dari pengguna akan muncul di halaman ini.
                                </p>
                            </td>
                        </tr>
                    @endforelse

                    <tr id="noSearchResult" hidden>
                        <td colspan="8" class="px-6 py-10 text-center text-gray-500">
                            Tidak ada pengajuan yang cocok dengan pencarian.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="pagination-footer">
            <p class="pagination-text" id="tableInfo" aria-live="polite">
                Menampilkan data pengajuan.
            </p>

            <nav class="pagination" id="requestPagination" aria-label="Navigasi halaman pengajuan"></nav>
        </div>
    </div>

    {{-- INFORMASI --}}
    <div class="mt-6 rounded-xl border border-gray-200 bg-white p-5 shadow-sm md:p-6">
        <h3 class="mb-2 text-base font-bold brown">Informasi Pengelolaan Restock</h3>
        <p class="text-sm leading-relaxed text-gray-600">
            Periksa judul buku, jumlah yang diajukan, dan alasan pengguna.
            Pengajuan berstatus Menunggu dapat disetujui atau ditolak.
            Jika menolak, admin wajib mengisi alasan agar pengguna mengetahui
            keputusan tersebut. Setelah diproses, status dan catatan admin
            akan ditampilkan pada tabel ini.
        </p>
    </div>

</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const tableBody = document.getElementById('requestTableBody');
    const pagination = document.getElementById('requestPagination');
    const tableInfo = document.getElementById('tableInfo');
    const noSearchResult = document.getElementById('noSearchResult');
    const emptyDataRow = document.getElementById('emptyDataRow');

    if (!searchInput || !statusFilter || !tableBody || !pagination || !tableInfo) {
        return;
    }

    const rows = Array.from(tableBody.querySelectorAll('.request-row'));
    const rowsPerPage = 5;
    let currentPage = 1;

    function getFilteredRows() {
        const keyword = searchInput.value.trim().toLocaleLowerCase('id');
        const status = statusFilter.value.toLowerCase();

        return rows.filter(function (row) {
            const text = (row.dataset.search || '').toLocaleLowerCase('id');
            const rowStatus = (row.dataset.status || '').toLowerCase();

            return text.includes(keyword) && (!status || rowStatus === status);
        });
    }

    function createPageButton(label, page, options = {}) {
        const button = document.createElement('button');

        button.type = 'button';
        button.className = 'page-button';
        button.textContent = label;
        button.disabled = Boolean(options.disabled);

        if (options.active) {
            button.classList.add('active');
            button.setAttribute('aria-current', 'page');
        }

        button.addEventListener('click', function () {
            if (button.disabled || currentPage === page) {
                return;
            }

            currentPage = page;
            renderTable();
        });

        pagination.appendChild(button);
    }

    function renderPagination(totalPages) {
        pagination.replaceChildren();

        if (totalPages <= 1) {
            return;
        }

        createPageButton('Sebelumnya', Math.max(1, currentPage - 1), {
            disabled: currentPage === 1
        });

        for (let page = 1; page <= totalPages; page++) {
            createPageButton(String(page), page, {
                active: page === currentPage
            });
        }

        createPageButton('Selanjutnya', Math.min(totalPages, currentPage + 1), {
            disabled: currentPage === totalPages
        });
    }

    function renderTable() {
        const filteredRows = getFilteredRows();
        const totalRows = filteredRows.length;
        const totalPages = Math.max(1, Math.ceil(totalRows / rowsPerPage));

        if (currentPage > totalPages) {
            currentPage = totalPages;
        }

        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = Math.min(startIndex + rowsPerPage, totalRows);

        rows.forEach(function (row) {
            row.hidden = true;
        });

        filteredRows.forEach(function (row, index) {
            const isVisible = index >= startIndex && index < endIndex;
            row.hidden = !isVisible;

            const numberCell = row.querySelector('.request-number');
            if (numberCell) {
                numberCell.textContent = index + 1;
            }
        });

        if (emptyDataRow) {
            emptyDataRow.hidden = rows.length > 0;
        }

        if (noSearchResult) {
            noSearchResult.hidden = !(rows.length > 0 && totalRows === 0);
        }

        if (totalRows === 0) {
            tableInfo.textContent = rows.length === 0
                ? 'Belum ada pengajuan.'
                : 'Tidak ada pengajuan yang cocok dengan pencarian atau filter.';
        } else {
            tableInfo.textContent =
                'Menampilkan ' + (startIndex + 1) +
                '–' + endIndex +
                ' dari ' + totalRows + ' pengajuan.';
        }

        renderPagination(totalPages);
    }

    searchInput.addEventListener('input', function () {
        currentPage = 1;
        renderTable();
    });

    statusFilter.addEventListener('change', function () {
        currentPage = 1;
        renderTable();
    });

    renderTable();
});
</script>
@endpush