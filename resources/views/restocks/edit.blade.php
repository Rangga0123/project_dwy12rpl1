<x-app-layout>
    <h1>Edit Data Barang</h1>
    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf @method('PUT')
        <p>Judul: <input type="text" name="title" value="{{ $book->title }}"></p>
        <p>Penulis: <input type="text" name="author" value="{{ $book->author }}"></p>
        <p>Stok: <input type="number" name="stock" value="{{ $book->stock }}"></p>
        <button type="submit">Update</button>
    </form>
</x-app-layout>