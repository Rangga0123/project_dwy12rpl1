<!-- ================= SIDEBAR ================= -->
<aside class="sidebar w-64 min-h-screen text-white fixed left-0 top-0 z-50">

    <!-- Logo -->
    <div class="p-5 text-center border-b border-white/20">
        <div class="text-5xl mb-2">📚</div>
        <h1 class="text-xl font-bold">Book Stock</h1>
        <p class="text-sm text-white/80">SMKN 5 Kabupaten Tangerang</p>
    </div>

    <!-- MENU -->
    <nav class="mt-5 px-3">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'menu-active' : 'hover:bg-white/10' }} mb-2">
            <span class="text-xl">🏠</span>
            <span>Dashboard</span>
        </a>

        <!-- Data Buku -->
        <a href="{{ route('books.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('books*') ? 'menu-active' : 'hover:bg-white/10' }} mb-2">
            <span class="text-xl">📚</span>
            <span>Data Buku</span>
        </a>

        <!-- Kategori -->
        <a href="{{ route('categories.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('categories*') ? 'menu-active' : 'hover:bg-white/10' }} mb-2">
            <span class="text-xl">📂</span>
            <span>Kategori Buku</span>
        </a>

        <!-- Supplier -->
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
            <span class="text-xl">🏢</span>
            <span>Supplier</span>
        </a>

        <!-- Pengajuan Restock -->
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
            <span class="text-xl">📄</span>
            <span>Pengajuan Restock</span>
        </a>

        <!-- Riwayat Restock -->
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
            <span class="text-xl">📋</span>
            <span>Riwayat Restock</span>
        </a>

        <!-- Laporan -->
        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 mb-2">
            <span class="text-xl">📊</span>
            <span>Laporan</span>
        </a>

        <!-- Profile -->
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('profile*') ? 'menu-active' : 'hover:bg-white/10' }} mb-2">
            <span class="text-xl">👤</span>
            <span>Profil</span>
        </a>
    </nav>

    <!-- Logout -->
    <div class="absolute bottom-5 left-3 right-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-600/80 transition">
                <span class="text-xl">🚪</span>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>