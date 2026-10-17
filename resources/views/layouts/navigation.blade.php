<nav x-data="{ open: false }"
    class="bg-white border-b border-[#eadfd5] shadow-sm">

    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            {{-- KIRI: JUDUL APLIKASI --}}
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-[#6b3f28] text-white">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5
                            5.757 5 4.172 5.477 3 6.253v13
                            C4.172 18.477 5.757 18 7.5 18
                            c1.746 0 3.332.477 4.5 1.253m0-13
                            C13.168 5.477 14.754 5 16.5 5
                            c1.746 0 3.332.477 4.5 1.253v13
                            C19.832 18.477 18.246 18 16.5 18
                            c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>

                <div>
                    <h1 class="text-sm sm:text-base font-bold text-[#6b3f28]">
                        Book Stock SMKN 5
                    </h1>
                    <p class="hidden sm:block text-xs text-gray-500">
                        Sistem Informasi Perpustakaan
                    </p>
                </div>
            </div>

            {{-- KANAN: PROFIL DESKTOP --}}
            <div class="hidden sm:flex items-center gap-3">
                <div class="text-right">
                    <p class="text-sm font-semibold text-gray-800">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ Auth::user()->role === 'admin' ? 'Administrator' : 'User' }}
                    </p>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button type="button"
                            class="flex items-center justify-center w-10 h-10 rounded-full
                            bg-[#f5e9de] text-[#6b3f28]
                            hover:bg-[#ead7c5] transition">
                            @if(Auth::user()->profile_photo)
                                <img
                                    src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                                    alt="Foto profil"
                                    class="w-10 h-10 rounded-full object-cover">
                            @else
                                <span class="font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                            @endif
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profil Saya
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-start block px-4 py-2 text-sm
                                text-gray-700 hover:bg-gray-100">
                                Keluar
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- HAMBURGER MOBILE --}}
            <div class="sm:hidden">
                <button @click="open = !open"
                    type="button"
                    class="inline-flex items-center justify-center p-2 rounded-lg
                    text-[#6b3f28] hover:bg-[#f5e9de] transition"
                    :aria-expanded="open.toString()"
                    aria-label="Buka menu">
                    <svg class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path x-show="!open"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>

                        <path x-show="open"
                            x-cloak
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- MENU MOBILE --}}
    <div x-show="open"
        x-cloak
        x-transition
        @click.outside="open = false"
        class="sm:hidden border-t border-[#eadfd5] bg-white">

        <div class="px-4 py-3 bg-[#faf6f2]">
            <p class="font-semibold text-sm text-[#6b3f28]">
                {{ Auth::user()->name }}
            </p>
            <p class="text-xs text-gray-500">
                {{ Auth::user()->email }}
            </p>
        </div>

        <div class="p-2 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')"
                :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('profile.edit')"
                :active="request()->routeIs('profile.edit')">
                Profil Saya
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-start px-4 py-2 text-sm text-gray-700
                    hover:bg-[#f5e9de] hover:text-[#6b3f28] rounded-md">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</nav>