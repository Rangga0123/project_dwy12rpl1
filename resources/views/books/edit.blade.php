<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku - Book Stock SMKN5</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .brown { color: #6b3f28; }
    </style>
</head>
<body class="bg-[#f7f4f1] p-8">

    <div class="max-w-xl mx-auto bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <h2 class="text-2xl font-bold brown mb-6">Edit Data Buku</h2>

        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Judul Buku</label>
                <input type="text" name="title" value="{{ old('title', $book->title) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-[#6b3f28]" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Kategori</label>
                <select name="category_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-[#6b3f28]" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $book->stock) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-[#6b3f28]" required>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('books.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg font-medium transition">Batal</a>
                <button type="submit" class="bg-[#6b3f28] hover:bg-[#553120] text-white px-4 py-2 rounded-lg font-medium transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>
</html>