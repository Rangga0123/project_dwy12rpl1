<x-app-layout>
    <h1>Tambah Barang Baru</h1>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <p>Judul: <input type="text" name="title" required></p>
        <p>Penulis: <input type="text" name="author" required></p>
        <p>Stok Awal: <input type="number" name="stock" required></p>
        <button type="submit">Simpan</button>
    </form>
</x-app-layout>