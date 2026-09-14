<x-app-layout>
    <h1>Daftar Restock Barang</h1>
    <a href="{{ route('books.create') }}">Tambah Barang Baru</a>
    
    <table border="1">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Stok Saat Ini</th>
                <th>Restock (Tambah Stok)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->stock }}</td>
                <td>
                    <!-- Form Restock Langsung -->
                    <form action="{{ route('books.restock', $book->id) }}" method="POST">
                        @csrf
                        <input type="number" name="added_stock" required placeholder="Jml...">
                        <button type="submit">Tambah</button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('books.edit', $book->id) }}">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>