<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Restock</title>
    <style>
        @page { margin: 22px 28px; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 8px;
            color: #222;
        }

        h1 {
            margin: 0 0 14px;
            font-size: 17px;
            color: #6b3f28;
            text-align: center;
        }

        table { width: 100%; border-collapse: collapse; }

        .data th, .data td {
            padding: 5px 5px;
            border: 1px solid #777;
            text-align: left;
            vertical-align: middle;
        }

        .data thead th {
            background: #f0e4d8;
            color: #6b3f28;
            font-weight: bold;
        }

        .data tbody tr:nth-child(even) { background: #fbf9f7; }
        .center { text-align: center !important; }
        .empty { padding: 18px !important; text-align: center !important; color: #777; }
    </style>
</head>
<body>

    <h1>Laporan Restock Buku</h1>
    <table class="data">
        <thead>
            <tr>
                <th class="center" style="width:3%;">No</th>
                <th style="width:9%;">Tanggal Pengajuan</th>
                <th>Judul Buku</th>
                <th style="width:9%;">Penerbit</th>
                <th style="width:9%;">Pengarang</th>
                <th class="center" style="width:6%;">Tahun Terbit</th>
                <th class="center" style="width:6%;">Tahun Bantuan</th>
                <th style="width:8%;">Kategori</th>
                <th class="center" style="width:7%;">Jumlah</th>
                <th class="center" style="width:7%;">Status</th>
                <th style="width:10%;">Terakhir Diperbarui</th>
            </tr>
        </thead>

        <tbody>
            @forelse($restocks as $restock)
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td>{{ optional($restock->created_at)->format('d-m-Y') }}</td>
                    <td>{{ optional($restock->book)->title ?? '-' }}</td>
                    <td>{{ optional($restock->book)->penerbit ?? '-' }}</td>
                    <td>{{ optional($restock->book)->pengarang ?? '-' }}</td>
                    <td class="center">{{ optional($restock->book)->tahun_terbit ?? '-' }}</td>
                    <td class="center">{{ optional($restock->book)->tahun_bantuan ?? '-' }}</td>
                    <td>{{ optional(optional($restock->book)->category)->name ?? '-' }}</td>
                    <td class="center">{{ number_format($restock->jumlah ?? 0, 0, ',', '.') }} Buku</td>
                    <td class="center">{{ ucfirst($restock->status) }}</td>
                    <td>{{ optional($restock->updated_at)->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="empty">Tidak ada data restock untuk filter yang dipilih.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>