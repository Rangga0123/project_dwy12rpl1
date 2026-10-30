<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku Perpustakaan</title>

    <style>
        @page {
            margin: 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #222;
        }

        h2 {
            text-align: center;
            font-size: 17px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #555;
            padding: 7px;
            text-align: left;
        }

        th {
            background-color: #eeeeee;
            text-align: center;
        }

        .center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Daftar Buku Perpustakaan</h2>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Judul Buku</th>
                <th>Penerbit</th>
                <th>Pengarang</th>
                <th>Tahun Terbit</th>
                <th>Tahun Bantuan</th>
                <th>Kategori</th>
                <th>Stok</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td>{{ $book->title ?? '-' }}</td>
                    <td>{{ $book->penerbit ?? '-' }}</td>
                    <td>{{ $book->pengarang ?? '-' }}</td>
                    <td class="center">{{ $book->tahun_terbit ?? '-' }}</td>
                    <td class="center">{{ $book->tahun_bantuan ?? '-' }}</td>
                    <td>
                        {{ optional($book->category)->name
                            ?? optional($book->category)->nama_kategori
                            ?? '-' }}
                    </td>
                    <td class="center">{{ $book->stock ?? 0 }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="center">
                        Belum ada data buku.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>