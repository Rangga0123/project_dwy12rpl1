@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<section class="dashboard-content p-8 page-enter">

    <!-- STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-7">

        <div class="card bg-white rounded-xl p-5 border border-gray-200">
            <p class="text-sm text-gray-500">Total Buku</p>
            <div class="flex items-end justify-between mt-3">
                <h3 class="text-3xl font-bold brown stat-number" data-target="{{ $totalBuku ?? 0 }}">0</h3>
                <span class="text-sm text-gray-400">Buku</span>
            </div>
        </div>

        <div class="card bg-white rounded-xl p-5 border border-gray-200">
            <p class="text-sm text-gray-500">Total Stok</p>
            <div class="flex items-end justify-between mt-3">
                <h3 class="text-3xl font-bold brown stat-number" data-target="{{ $totalStok ?? 0 }}">0</h3>
                <span class="text-sm text-gray-400">Unit</span>
            </div>
        </div>

        <div class="card bg-white rounded-xl p-5 border border-gray-200">
            <p class="text-sm text-gray-500">Pengajuan Restock</p>
            <div class="flex items-end justify-between mt-3">
                <h3 class="text-3xl font-bold brown stat-number" data-target="{{ $totalPengajuan ?? 0 }}">0</h3>
                <span class="text-sm text-gray-400">Pengajuan</span>
            </div>
        </div>

        <div class="card bg-white rounded-xl p-5 border border-gray-200">
            <p class="text-sm text-gray-500">Restock Selesai</p>
            <div class="flex items-end justify-between mt-3">
                <h3 class="text-3xl font-bold brown stat-number" data-target="{{ $totalRestockSelesai ?? 0 }}">0</h3>
                <span class="text-sm text-gray-400">Selesai</span>
            </div>
        </div>

    </div>

    <!-- RINGKASAN DAN AKSI CEPAT -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- RINGKASAN RESTOCK -->
        <div class="xl:col-span-2 bg-white rounded-xl border border-gray-200 p-6 shadow-sm">

            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-lg font-bold brown">Ringkasan Restock</h3>
                    <p class="text-sm text-gray-500 mt-1">Ringkasan status pengajuan buku</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center text-xl">▤</div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div class="rounded-xl border border-orange-100 bg-orange-50/60 p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-2.5 h-2.5 rounded-full bg-orange-400"></span>
                        <span class="text-sm font-medium text-gray-600">Menunggu</span>
                    </div>
                    <div class="flex items-end justify-between">
                        <span class="text-3xl font-bold text-orange-700">{{ $totalMenunggu ?? 0 }}</span>
                        <span class="text-xs text-gray-500 pb-1">Pengajuan</span>
                    </div>
                </div>

                <div class="rounded-xl border border-green-100 bg-green-50/60 p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-2.5 h-2.5 rounded-full bg-green-500"></span>
                        <span class="text-sm font-medium text-gray-600">Selesai</span>
                    </div>
                    <div class="flex items-end justify-between">
                        <span class="text-3xl font-bold text-green-700">{{ $totalRestockSelesai ?? 0 }}</span>
                        <span class="text-xs text-gray-500 pb-1">Pengajuan</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- AKSI CEPAT -->
        <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
            <h3 class="text-lg font-bold brown mb-4">Aksi Cepat</h3>

            <a href="{{ route('books.create') }}"
               class="quick-item flex items-center gap-3 p-3 rounded-lg bg-[#f8f5f2] mb-2.5">
                <div class="w-9 h-9 flex-shrink-0 rounded-lg bg-white flex items-center justify-center brown border border-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold brown">Tambah Buku</p>
                    <p class="text-xs text-gray-500 mt-0.5">Tambahkan data buku baru</p>
                </div>
                <svg class="w-4 h-4 ml-auto flex-shrink-0 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/>
                </svg>
            </a>

            <a href="{{ route('admin.restock.index') }}"
               class="quick-item flex items-center gap-3 p-3 rounded-lg bg-[#f8f5f2]">
                <div class="w-9 h-9 flex-shrink-0 rounded-lg bg-white flex items-center justify-center brown border border-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l3 3v15H6V3z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 15h6"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold brown">Pengajuan Restock</p>
                    <p class="text-xs text-gray-500 mt-0.5">Kelola pengajuan buku</p>
                </div>
                <svg class="w-4 h-4 ml-auto flex-shrink-0 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/>
                </svg>
            </a>
        </div>

    </div>

    <!-- INFORMASI -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 mt-6 shadow-sm">
        <h3 class="text-lg font-bold brown mb-2">Book Stock SMKN 5</h3>
        <p class="text-sm text-gray-600 leading-relaxed">
            Sistem ini digunakan untuk membantu pengelolaan
            data buku, stok buku, pengajuan restock,
            serta penambahan stok perpustakaan SMKN 5 Kabupaten Tangerang.
        </p>
    </div>

</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ANIMASI ANGKA STATISTIK */
    document.querySelectorAll('.stat-number').forEach(function (element) {
        const target = parseInt(element.dataset.target, 10) || 0;

        if (target === 0) {
            element.textContent = '0';
            return;
        }

        let current = 0;
        const increment = Math.max(1, Math.ceil(target / 30));

        const timer = setInterval(function () {
            current += increment;

            if (current >= target) {
                element.textContent = target.toLocaleString('id-ID');
                clearInterval(timer);
            } else {
                element.textContent = current.toLocaleString('id-ID');
            }
        }, 30);
    });

    /* ANIMASI PROGRESS BAR JIKA ADA */
    setTimeout(function () {
        document.querySelectorAll('.progress-bar').forEach(function (bar) {
            bar.style.width = bar.dataset.width || '0%';
        });
    }, 200);

    /* SAPAAN OTOMATIS */
    const greetingEl = document.getElementById('greeting-text');
    const hour = new Date().getHours();
    const userName = @json(Auth::user()->name);

    let greeting;

    if (hour >= 4 && hour < 11) {
        greeting = `Selamat pagi, ${userName}. Semangat beraktivitas!`;
    } else if (hour >= 11 && hour < 15) {
        greeting = `Selamat siang, ${userName}. Tetap produktif ya!`;
    } else if (hour >= 15 && hour < 18) {
        greeting = `Selamat sore, ${userName}. Pekerjaan hampir beres!`;
    } else {
        greeting = `Selamat malam, ${userName}. Waktunya istirahat santai.`;
    }

    if (greetingEl) {
        greetingEl.textContent = greeting;
    }

});
</script>
@endpush