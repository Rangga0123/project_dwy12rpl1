<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengajuan Restock - Book Stock SMKN5</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f7f3ef;
            color: #5a2f18;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0 0 8px;
            font-size: 32px;
        }

        .header p {
            margin: 0;
            color: #777;
        }

        .card {
            background: white;
            border: 1px solid #e0d2c8;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        }

        .success {
            background: #e8f8ee;
            border: 1px solid #a8dfbc;
            color: #18733c;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        select,
        input,
        textarea {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #ccc;
            border-radius: 9px;
            font-size: 15px;
            outline: none;
        }

        select:focus,
        input:focus,
        textarea:focus {
            border-color: #8b451f;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .error {
            color: #c62828;
            font-size: 14px;
            margin-top: 5px;
        }

        .button {
            border: none;
            background: #8b451f;
            color: white;
            padding: 13px 25px;
            border-radius: 9px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .button:hover {
            background: #6f3517;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            color: #8b451f;
            text-decoration: none;
            font-weight: bold;
        }

        .back:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Pengajuan Restock</h1>
        <p>Ajukan penambahan stok buku perpustakaan.</p>
    </div>

    @if(session('success'))
        <div class="success">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <form action="{{ route('user.restock.store') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="book_id">Pilih Buku</label>

                <select name="book_id" id="book_id" required>

                    <option value="">-- Pilih Buku --</option>

                    @foreach($books as $book)

                        <option value="{{ $book->id }}"
                            {{ old('book_id') == $book->id ? 'selected' : '' }}>

                            {{ $book->title }}
                            — Stok saat ini: {{ $book->stock }}

                        </option>

                    @endforeach

                </select>

                @error('book_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">

                <label for="jumlah">
                    Jumlah Restock
                </label>

                <input
                    type="number"
                    name="jumlah"
                    id="jumlah"
                    min="1"
                    value="{{ old('jumlah') }}"
                    placeholder="Masukkan jumlah buku"
                    required
                >

                @error('jumlah')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            <div class="form-group">

                <label for="alasan">
                    Alasan Pengajuan
                </label>

                <textarea
                    name="alasan"
                    id="alasan"
                    placeholder="Contoh: Stok buku sudah hampir habis."
                >{{ old('alasan') }}</textarea>

                @error('alasan')
                    <div class="error">{{ $message }}</div>
                @enderror

            </div>


            <button type="submit" class="button">
                Kirim Pengajuan
            </button>

        </form>

    </div>

    <a href="{{ route('dashboard') }}" class="back">
        ← Kembali ke Dashboard
    </a>

</div>

</body>
</html>