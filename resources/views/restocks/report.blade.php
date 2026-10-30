@extends('admin.layouts.app')

@section('title', 'Laporan Restock - Book Stock SMKN 5')

@section('content')
<style>
    .report-page {
        --brown: #6b3f28;
        --orange: #d96b24;
        --muted: #81756d;
        padding: 24px;
        color: #33271f;
        font-family: Arial, Helvetica, sans-serif;
    }

    .report-page * { box-sizing: border-box; }

    .report-page .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        margin-bottom: 24px;
    }

    .report-page .page-title {
        margin: 0;
        color: var(--brown);
        font-size: 27px;
        font-weight: 800;
    }

    .report-page .page-subtitle {
        margin: 7px 0 0;
        color: var(--muted);
        font-size: 13px;
    }

    .report-page .header-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .report-page .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        height: 40px;
        padding: 0 16px;
        border: 1px solid transparent;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s;
        white-space: nowrap;
    }

    .report-page .btn:hover { filter: brightness(.95); }
    .report-page .btn-brown { background: var(--brown); color: #fff; }
    .report-page .btn-green { background: #198754; color: #fff; }
    .report-page .btn-outline {
        background: #fff;
        color: #51443b;
        border-color: #d5d0ca;
    }

    .report-page .icon,
    .report-page .icon svg { width: 16px; height: 16px; }

    .report-page .icon svg {
        fill: none;
        stroke: currentColor;
        stroke-width: 1.9;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    /* Kartu ringkasan */
    .report-page .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 18px;
        margin-bottom: 24px;
    }

    .report-page .summary-card {
        padding: 18px 20px;
        background: #fff;
        border: 1px solid #e8e1db;
        border-radius: 12px;
    }

    .report-page .summary-card p {
        margin: 0;
        color: var(--muted);
        font-size: 13px;
    }

    .report-page .summary-card .summary-value {
        margin-top: 10px;
        color: var(--brown);
        font-size: 28px;
        font-weight: 800;
    }

    .report-page .summary-card.waiting .summary-value { color: #c2410c; }
    .report-page .summary-card.done .summary-value { color: #15803d; }

    /* Kartu utama */
    .report-page .report-card {
        background: #fff;
        border: 1px solid #e8e1db;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(69,43,26,.05);
    }

    .report-page .card-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 20px 22px;
        border-bottom: 1px solid #eee7e1;
    }

    .report-page .card-heading h2 {
        margin: 0;
        color: var(--brown);
        font-size: 17px;
        font-weight: 800;
    }

    .report-page .card-heading p {
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 12px;
    }

    /* Filter */
    .report-page .filter-form {
        display: flex;
        align-items: flex-end;
        flex-wrap: wrap;
        gap: 12px;
        padding: 17px 22px;
    }

    .report-page .filter-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .report-page .filter-group label {
        color: #51443b;
        font-size: 11px;
        font-weight: 700;
    }

    .report-page .filter-input {
        height: 40px;
        min-width: 160px;
        padding: 0 12px;
        border: 1px solid #d5d0ca;
        border-radius: 8px;
        outline: none;
        background: #fff;
        font-size: 12px;
    }

    .report-page .filter-input:focus {
        border-color: var(--orange);
        box-shadow: 0 0 0 3px rgba(217,107,36,.12);
    }

    .report-page .filter-search { min-width: 220px; }

    /* Tabel */
    .report-page .table-wrapper {
        width: 100%;
        overflow-x: auto;
        padding: 0 22px 20px;
    }

    .report-page .report-table {
        width: 100%;
        min-width: 1150px;
        border-collapse: collapse;
        border: 1px solid #d5d0ca;
        font-size: 12px;
    }

    .report-page .report-table th,
    .report-page .report-table td {
        padding: 12px;
        border: 1px solid #d5d0ca;
        text-align: left;
        vertical-align: middle;
    }

    .report-page .report-table thead th {
        background: #f4e9df;
        color: var(--brown);
        font-weight: 800;
        white-space: nowrap;
    }

    .report-page .report-table tbody tr:nth-child(even) { background: #fcfaf8; }
    .report-page .report-table tbody tr:hover { background: #fff2e8; }
    .report-page .text-center { text-align: center !important; }
    .report-page .book-title { font-weight: 700; color: #392a20; }

    .report-page .status-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 800;
    }

    .report-page .status-menunggu { background: #fff0df; color: #b45309; }
    .report-page .status-selesai { background: #e8f7ee; color: #187443; }
    .report-page .status-ditolak { background: #fdeaea; color: #b42318; }

    .report-page .empty-message {
        padding: 35px !important;
        color: #887d74;
        text-align: center !important;
    }

    /* Pagination */
    .report-page .pagination-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        padding: 0 22px 20px;
        color: var(--muted);
        font-size: 12px;
    }

    .report-page .report-pagination { display: flex; }

    .report-page .page-button {
        display: inline-flex;
        min-width: 36px;
        height: 38px;
        padding: 0 12px;
        align-items: center;
        justify-content: center;
        border: 1px solid #ded8d2;
        border-right: 0;
        background: #fff;
        color: var(--brown);
        font-size: 13px;
        text-decoration: none;
    }

    .report-page .page-button:first-child { border-radius: 5px 0 0 5px; }

    .report-page .page-button:last-child {
        border-right: 1px solid #ded8d2;
        border-radius: 0 5px 5px 0;
    }

    .report-page .page-button:hover:not(.disabled):not(.active) { background: #fff2e8; }

    .report-page .page-button.active {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }

    .report-page .page-button.disabled {
        color: #9b918a;
        cursor: not-allowed;
    }

    .report-page .print-only { display: none; }

    @media (max-width: 1024px) {
        .report-page .summary-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .report-page { padding: 15px; }
        .report-page .page-title { font-size: 23px; }
        .report-page .header-actions { width: 100%; }
        .report-page .header-actions .btn { flex: 1; }
        .report-page .filter-group,
        .report-page .filter-input { width: 100%; }
        .report-page .pagination-info { padding: 0 14px 16px; }
    }

    @media (max-width: 480px) {
        .report-page .summary-grid { grid-template-columns: 1fr; }
    }

    @media print {
        @page { size: A4 landscape; margin: 10mm; }

        body * { visibility: hidden !important; }

        .report-page,
        .report-page * { visibility: visible !important; }

        .report-page {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            background: #fff !important;
            color: #000 !important;
        }

        .report-page .header-actions,
        .report-page .filter-form,
        .report-page .pagination-info { display: none !important; }

        .report-page .print-only { display: block !important; margin-bottom: 10px; font-size: 11px; color: #333; }

        .report-page .summary-grid { gap: 8px !important; margin-bottom: 12px !important; }
        .report-page .summary-card { padding: 8px 10px !important; border: 1px solid #999 !important; }
        .report-page .summary-card .summary-value { font-size: 16px !important; color: #000 !important; margin-top: 4px !important; }

        .report-page .report-card { border: none !important; box-shadow: none !important; }
        .report-page .card-heading { padding: 8px 0 !important; }
        .report-page .table-wrapper { padding: 0 !important; overflow: visible !important; }

        .report-page .report-table { min-width: 0 !important; font-size: 9px !important; }

        .report-page .report-table th,
        .report-page .report-table td {
            padding: 6px !important;
            border: 1px solid #777 !important;
            color: #000 !important;
        }

        .report-page .report-table thead th { background: #eee !important; }

        .report-page .status-badge {
            background: transparent !important;
            color: #000 !important;
            padding: 0 !important;
        }

        .report-page .report-table tbody tr { break-inside: avoid; }
    }
</style>

<div class="report-page">
    <header class="page-header">
        <div>
            <h1 class="page-title">Laporan Restock</h1>
            <p class="page-subtitle">
                Rekap pengajuan dan penambahan stok buku perpustakaan SMKN 5 Kabupaten Tangerang.
            </p>
        </div>

        <div class="header-actions">
            <a href="{{ route('admin.restock.report.pdf', request()->query()) }}"
               id="pdfReportBtn" class="btn btn-brown">
                <span class="icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8zM14 3v5h5M9 13h6M9 17h6"/></svg>
                </span>
                Cetak PDF
            </a>

            <button type="button" id="importReportBtn" class="btn btn-green">
                <span class="icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M12 16V4m-5 5 5-5 5 5M4 16v4h16v-4"/></svg>
                </span>
                Import Excel
            </button>

            <button type="button" id="exportReportBtn" class="btn btn-green">
                <span class="icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M12 4v12m-5-5 5 5 5-5M4 20h16"/></svg>
                </span>
                Export Excel
            </button>

            <input type="file" id="importReportFile" accept=".xlsx,.xls,.csv" style="display:none;">
        </div>
    </header>

    <p class="print-only">
        Dicetak pada: {{ now()->format('d-m-Y H:i') }}
        @if(request('dari') || request('sampai'))
            | Periode: {{ request('dari') ?: '-' }} s/d {{ request('sampai') ?: '-' }}
        @endif
        @if(request('status'))
            | Status: {{ ucfirst(request('status')) }}
        @endif
    </p>

    <!-- RINGKASAN -->
    <div class="summary-grid">
        <div class="summary-card">
            <p>Total Pengajuan</p>
            <div class="summary-value">{{ number_format($totalPengajuan, 0, ',', '.') }}</div>
        </div>

        @foreach($statusCounts as $status => $count)
            <div class="summary-card">
                <p>{{ ucfirst($status) }}</p>
                <div class="summary-value">{{ number_format($count, 0, ',', '.') }}</div>
            </div>
        @endforeach

        <div class="summary-card">
            <p>Total Jumlah Buku Diajukan</p>
            <div class="summary-value">{{ number_format($totalJumlah, 0, ',', '.') }}</div>
        </div>
    </div>

    <section class="report-card">
        <div class="card-heading">
            <div>
                <h2>Riwayat Restock</h2>
                <p>Data pengajuan restock sesuai filter yang dipilih.</p>
            </div>

            <div style="font-size:12px;color:#796b60;">
                Total data:
                <strong style="color:#6b3f28;">{{ $restocks->total() }}</strong>
            </div>
        </div>

        <!-- FILTER -->
        <form method="GET" action="{{ route('admin.restock.report') }}" class="filter-form">
            <div class="filter-group">
                <label for="search">Cari Buku</label>
                <input type="search" id="search" name="search"
                       class="filter-input filter-search"
                       placeholder="Judul buku..."
                       value="{{ request('search') }}">
            </div>

            <div class="filter-group">
                <label for="status">Status</label>
                <select id="status" name="status" class="filter-input">
                    <option value="">Semua Status</option>
                    @foreach($statusOptions as $statusOption)
                        <option value="{{ $statusOption }}" @selected(request('status') === $statusOption)>
                            {{ ucfirst($statusOption) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="dari">Dari Tanggal</label>
                <input type="date" id="dari" name="dari" class="filter-input" value="{{ request('dari') }}">
            </div>

            <div class="filter-group">
                <label for="sampai">Sampai Tanggal</label>
                <input type="date" id="sampai" name="sampai" class="filter-input" value="{{ request('sampai') }}">
            </div>

            <button type="submit" class="btn btn-brown">Terapkan</button>
            <a href="{{ route('admin.restock.report') }}" class="btn btn-outline">Reset</a>
        </form>

        <!-- TABEL -->
        <div class="table-wrapper">
            <table class="report-table" id="reportTable">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Judul Buku</th>
                        <th>Penerbit</th>
                        <th>Pengarang</th>
                        <th class="text-center">Tahun Terbit</th>
                        <th class="text-center">Tahun Bantuan</th>
                        <th>Kategori</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Status</th>
                        <th>Terakhir Diperbarui</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($restocks as $restock)
                        <tr>
                            <td class="text-center">{{ $restocks->firstItem() + $loop->index }}</td>
                            <td>{{ optional($restock->created_at)->format('d-m-Y') }}</td>
                            <td class="book-title">{{ optional($restock->book)->title ?? '-' }}</td>
                            <td>{{ optional($restock->book)->penerbit ?? '-' }}</td>
                            <td>{{ optional($restock->book)->pengarang ?? '-' }}</td>
                            <td class="text-center">{{ optional($restock->book)->tahun_terbit ?? '-' }}</td>
                            <td class="text-center">{{ optional($restock->book)->tahun_bantuan ?? '-' }}</td>
                            <td>{{ optional(optional($restock->book)->category)->name ?? '-' }}</td>
                            <td class="text-center">{{ number_format($restock->jumlah ?? 0, 0, ',', '.') }} Buku</td>
                            <td class="text-center">
                                @php
                                    $s = strtolower((string) $restock->status);
                                    $badgeClass = match (true) {
                                        str_contains($s, 'tolak') || $s === 'rejected' => 'status-ditolak',
                                        str_contains($s, 'selesai') || str_contains($s, 'setuju') || $s === 'approved' => 'status-selesai',
                                        default => 'status-menunggu',
                                    };
                                @endphp
                                <span class="status-badge {{ $badgeClass }}">
                                    {{ ucfirst($restock->status) }}
                                </span>
                            </td>
                            <td>{{ optional($restock->updated_at)->format('d-m-Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="empty-message">
                                Tidak ada data restock untuk filter yang dipilih.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-info">
            <div>
                @if($restocks->total() > 0)
                    Menampilkan {{ $restocks->firstItem() }}–{{ $restocks->lastItem() }}
                    dari {{ $restocks->total() }} data.
                @else
                    Belum ada data restock.
                @endif
            </div>

            @if($restocks->hasPages())
                <nav class="report-pagination" aria-label="Navigasi halaman laporan">
                    @if($restocks->onFirstPage())
                        <span class="page-button disabled">Sebelumnya</span>
                    @else
                        <a href="{{ $restocks->previousPageUrl() }}" class="page-button">Sebelumnya</a>
                    @endif

                    @foreach($restocks->getUrlRange(1, $restocks->lastPage()) as $page => $url)
                        @if($page == $restocks->currentPage())
                            <span class="page-button active" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="page-button">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($restocks->hasMorePages())
                        <a href="{{ $restocks->nextPageUrl() }}" class="page-button">Selanjutnya</a>
                    @else
                        <span class="page-button disabled">Selanjutnya</span>
                    @endif
                </nav>
            @endif
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('reportTable');
    const exportButton = document.getElementById('exportReportBtn');
    const importButton = document.getElementById('importReportBtn');
    const importFile = document.getElementById('importReportFile');

    // IMPORT EXCEL - PRATINJAU (data belum disimpan ke database)
    if (importButton && importFile) {
        importButton.addEventListener('click', function () {
            importFile.click();
        });

        importFile.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            if (typeof XLSX === 'undefined') {
                alert('Library Excel gagal dimuat. Periksa koneksi internet.');
                this.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                try {
                    const workbook = XLSX.read(event.target.result, { type: 'array' });
                    const sheet = workbook.Sheets[workbook.SheetNames[0]];
                    const data = XLSX.utils.sheet_to_json(sheet, { defval: '' });

                    if (!data.length) {
                        alert('File Excel tidak memiliki data.');
                        return;
                    }

                    alert(
                        'File berhasil dibaca: ' + file.name +
                        '\nJumlah baris data: ' + data.length +
                        '\n\nIni hanya pratinjau. Data belum disimpan ke database.'
                    );

                    console.log('Pratinjau Excel:', data);
                } catch (error) {
                    console.error(error);
                    alert('File Excel gagal dibaca. Pastikan format file benar.');
                } finally {
                    importFile.value = '';
                }
            };

            reader.onerror = function () {
                alert('File gagal dibaca.');
                importFile.value = '';
            };

            reader.readAsArrayBuffer(file);
        });
    }

    if (exportButton && table) {
        exportButton.addEventListener('click', function () {
            if (typeof XLSX === 'undefined') {
                alert('Library Excel gagal dimuat. Periksa koneksi internet.');
                return;
            }

            const rows = Array.from(table.querySelectorAll('tbody tr'))
                .filter(function (row) { return !row.querySelector('.empty-message'); });

            if (rows.length === 0) {
                alert('Tidak ada data yang dapat diekspor.');
                return;
            }

            const data = [
                Array.from(table.querySelectorAll('thead th')).map(function (th) {
                    return th.innerText.trim();
                })
            ];

            rows.forEach(function (row) {
                data.push(Array.from(row.querySelectorAll('td')).map(function (td) {
                    return td.innerText.trim().replace(/\s+/g, ' ');
                }));
            });

            const worksheet = XLSX.utils.aoa_to_sheet(data);
            const workbook = XLSX.utils.book_new();

            worksheet['!cols'] = data[0].map(function (header) {
                return { wch: Math.max(String(header).length + 5, 18) };
            });

            XLSX.utils.book_append_sheet(workbook, worksheet, 'Laporan Restock');

            const tanggal = new Date().toISOString().slice(0, 10);
            XLSX.writeFile(workbook, 'Laporan_Restock_SMKN5_' + tanggal + '.xlsx');
        });
    }
});
</script>
@endsection