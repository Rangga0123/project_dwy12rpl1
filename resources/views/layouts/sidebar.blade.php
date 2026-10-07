<!-- ================= SIDEBAR ================= -->
<aside class="sidebar w-64 min-h-screen text-white fixed left-0 top-0 z-50">

    <!-- Logo -->
    <div class="p-5 text-center border-b border-white/20">

        <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-white p-1.5 flex items-center justify-center shadow-md school-logo overflow-hidden">
            <img
                src="{{ asset('images/logo-smkn5.png') }}"
                alt="Logo SMKN 5 Kabupaten Tangerang"
                class="w-full h-full object-contain"
            >
        </div>

        <h1 class="text-xl font-bold">
            Book Stock
        </h1>

        <p class="text-xs text-white/70 mt-1">
            SMKN 5 Kabupaten Tangerang
        </p>

    </div>


    <!-- MENU -->
    <nav class="mt-5 px-3">

        <!-- DASHBOARD -->
        <a href="{{ route('dashboard') }}"
           class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2
           {{ request()->routeIs('dashboard') ? 'menu-active' : '' }}">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="1.8"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M3 10.5L12 3l9 7.5"/>

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 9.5V21h14V9.5"/>

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M9 21v-6h6v6"/>

            </svg>

            <span class="text-sm">
                Dashboard
            </span>

        </a>


        <!-- DATA BUKU -->
        <a href="{{ route('books.index') }}"
           class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2
           {{ request()->routeIs('books.*') ? 'menu-active' : '' }}">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="1.8"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 4h12a2 2 0 012 2v13H7a2 2 0 01-2-2V4z"/>

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 17a2 2 0 012-2h12"/>

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M9 7h6M9 10h5"/>

            </svg>

            <span class="text-sm">
                Data Buku
            </span>

        </a>


        <!-- KATEGORI -->
        <a href="{{ route('categories.index') }}"
           class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2
           {{ request()->routeIs('categories.*') ? 'menu-active' : '' }}">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="1.8"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M3 6.5A2.5 2.5 0 015.5 4H10l2 2h6.5A2.5 2.5 0 0121 8.5v9A2.5 2.5 0 0118.5 20h-13A2.5 2.5 0 013 17.5v-11z"/>

            </svg>

            <span class="text-sm">
                Kategori Buku
            </span>

        </a>


        <!-- SUPPLIER -->
        <a href="#"
           class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="1.8"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M3 21h18"/>

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 21V7l7-4 7 4v14"/>

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M9 21v-5h6v5M9 9h.01M12 9h.01M15 9h.01"/>

            </svg>

            <span class="text-sm">
                Supplier
            </span>

        </a>


        <!-- PENGAJUAN RESTOCK -->
        <a href="{{ route('user.restock.create') }}"
           class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2
           {{ request()->routeIs('user.restock.create') ? 'menu-active' : '' }}">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="1.8"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M6 3h9l3 3v15H6V3z"/>

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M14 3v4h4M9 12h6M9 15h6"/>

            </svg>

            <span class="text-sm">
                Pengajuan Restock
            </span>

        </a>


        <!-- RIWAYAT RESTOCK -->
        <a href="{{ route('user.restock.history') }}"
           class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2
           {{ request()->routeIs('user.restock.history') ? 'menu-active' : '' }}">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="1.8"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M4 5h16v14H4z"/>

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M8 9h8M8 12h8M8 15h5"/>

            </svg>

            <span class="text-sm">
                Riwayat Restock
            </span>

        </a>


        <!-- LAPORAN -->
        <a href="#"
           class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="1.8"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 20V10M12 20V4M19 20v-7"/>

            </svg>

            <span class="text-sm">
                Laporan
            </span>

        </a>


        <!-- PROFIL -->
        <a href="{{ route('profile.edit') }}"
           class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg mb-2
           {{ request()->routeIs('profile.*') ? 'menu-active' : '' }}">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="1.8"
                 viewBox="0 0 24 24">

                <circle cx="12"
                        cy="8"
                        r="3"/>

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 20a7 7 0 0114 0"/>

            </svg>

            <span class="text-sm">
                Profil
            </span>

        </a>


        <!-- PEMBATAS -->
        <div class="border-t border-white/15 my-3"></div>


        <!-- LOGOUT -->
        <form method="POST"
              action="{{ route('logout') }}">

            @csrf

            <button type="submit"
                    class="menu-item w-full flex items-center gap-3 px-4 py-3 rounded-lg text-left hover:bg-red-600/80">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M10 17l5-5-5-5M15 12H3"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M21 19V5a2 2 0 00-2-2h-5"/>

                </svg>

                <span class="text-sm">
                    Logout
                </span>

            </button>

        </form>

    </nav>

</aside>