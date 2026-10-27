@extends('admin.layouts.app')

@section('title', 'Pengajuan Restock')
@section('subtitle', 'Kelola permintaan penambahan stok buku')

@push('styles')
<style>
    .form-control {
        width: 100%;
        border: 1px solid #d6d3d1;
        border-radius: 8px;
        padding: 9px 11px;
        font-size: 13px;
        outline: none;
        background: white;
    }
    .form-control:focus {
        border-color: #9a6848;
        box-shadow: 0 0 0 3px rgba(107,63,40,.10);
    }

    .status {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }
    .status-menunggu  { background: #fef3c7; color: #92400e; }
    .status-disetujui { background: #dcfce7; color: #166534; }
    .status-ditolak   { background: #fee2e2; color: #991b1b; }

    .btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        width: 100%;
        padding: 9px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: background .2s;
    }
    .btn-approve { color: white; background: #15803d; }
    .btn-approve:hover { background: #166534; }
    .btn-reject { color: white; background: #b91c1c; }
    .btn-reject:hover { background: #991b1b; }
</style>
@endpush

@section('content')
<section class="page-content p-8 page-enter">

    <div class="mb-7">
        <p class="text-sm text-gray-500 mb-2">Dashboard / Pengajuan Restock</p>
        <h1 class="text-2xl font-bold brown">Pengajuan Restock Buku</h1>
        <p class="text-sm text-gray-500 mt-2">
            Periksa, setujui, atau tolak permintaan restock dari pengguna.
        </p>
    </div>

    @if(session('success'))
        <div class="mb-5 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">
            <p class="font-semibold mb-2">Periksa kembali data berikut:</p>
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- STATISTIK -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-7">
        <div class="card bg-white rounded-xl p-5 border border-gray-200">
            <p class="text-sm text-gray-500">Total Pengajuan</p>
            <h3 class="text-3xl font-bold brown mt-3">{{ $requests->count() }}</h3>
            <p class="text-xs text-gray-400 mt-1">Semua permintaan</p>
        </div>

        <div class="card bg-white rounded-xl p-5 border border-gray-200">
            <p class="text-sm text-gray-500">Menunggu</p>
            <h3 class="text-3xl font-bold text-yellow-700 mt-3">{{ $requests->where('status', 'menunggu')->count() }}</h3>
            <p class="text-xs text-gray-400 mt-1">Perlu diperiksa</p>
        </div>

        <div class="card bg-white rounded-xl p-5 border border-gray-200">
            <p class="text-sm text-gray-500">Disetujui</p>
            <h3 class="text-3xl font-bold text-green-700 mt-3">{{ $requests->where('status', 'disetujui')->count() }}</h3>
            <p class="text-xs text-gray-400 mt-1">Pengajuan diterima</p>
        </div>

        <div class="card bg-white rounded-xl p-5 border border-gray-200">
            <p class="text-sm text-gray-500">Ditolak</p>
            <h3 class="text-3xl font-bold text-red-700 mt-3">{{ $requests->where('status', 'ditolak')->count() }}</h3>
            <p class="text-xs text-gray-400 mt-1">Pengajuan ditolak</p>
        </div>
    </div>

    <!-- TABEL -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-5 md:p-6 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h3 class="text-lg font-bold brown">Daftar Pengajuan</h3>
                <p class="text-sm text-gray-500 mt-1">Data permintaan restock buku dari pengguna.</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <input type="text" id="searchInput" placeholder="Cari nama atau judul buku..."
                       class="form-control sm:w-64" aria-label="Cari pengajuan">

                <select id="statusFilter" class="form-control sm:w-40" aria-label="Filter status">
                    <option value="">Semua Status</option>
                    <option value="menunggu">Menunggu</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-[#f8f5f2] text-gray-600">
                    <tr>
                        <th class="px-5 py-4 text-left">No.</th>
                        <th class="px-5 py-4 text-left">Pengguna</th>
                        <th class="px-5 py-4 text-left">Buku</th>
                        <th class="px-5 py-4 text-center">Jumlah</th>
                        <th class="px-5 py-4 text-left">Alasan</th>
                        <th class="px-5 py-4 text-left">Status</th>
                        <th class="px-5 py-4 text-left">Catatan Admin</th>
                        <th class="px-5 py-4 text-left">Tindakan</th>
                    </tr>
                </thead>

                <tbody id="requestTableBody" class="divide-y divide-gray-100">
                    @forelse($requests as $item)
                        <tr class="request-row hover:bg-[#fcfaf8] align-top"
                            data-search="{{ strtolower(($item->user->name ?? 'pengguna') . ' ' . ($item->book->title ?? 'buku')) }}"
                            data-status="{{ strtolower($item->status ?? '') }}">

                            <td class="px-5 py-5 text-gray-500">{{ $loop->iteration }}</td>

                            <td class="px-5 py-5">
                                <p class="font-semibold text-gray-800">
                                    {{ $item->user->name ?? 'Pengguna tidak ditemukan' }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">ID: {{ $item->user_id }}</p>
                            </td>

                            <td class="px-5 py-5">
                                <p class="font-semibold brown">
                                    {{ $item->book->title ?? 'Buku tidak ditemukan' }}
                                </p>
                            </td>

                            <td class="px-5 py-5 text-center">
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-lg bg-[#f4eee9] brown font-bold">
                                    {{ $item->jumlah }}
                                </span>
                            </td>

                            <td class="px-5 py-5 text-gray-600 min-w-40 max-w-xs">
                                {{ $item->alasan ?: 'Tidak ada alasan' }}
                            </td>

                            <td class="px-5 py-5">
                                @if($item->status === 'menunggu')
                                    <span class="status status-menunggu">Menunggu</span>
                                @elseif($item->status === 'disetujui')
                                    <span class="status status-disetujui">Disetujui</span>
                                @elseif($item->status === 'ditolak')
                                    <span class="status status-ditolak">Ditolak</span>
                                @else
                                    <span class="status bg-gray-100 text-gray-600">
                                        {{ ucfirst($item->status ?? 'Tidak diketahui') }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-5 text-gray-600 min-w-40 max-w-xs">
                                {{ $item->catatan_admin ?: '—' }}
                            </td>

                            <td class="px-5 py-5 min-w-64">
                                @if($item->status === 'menunggu')
                                    <form method="POST" action="{{ route('admin.restock.approve', $item->id) }}" class="mb-3">
                                        @csrf
                                        @method('PATCH')

                                        <label class="block text-xs text-gray-500 mb-1">Catatan persetujuan (opsional)</label>
                                        <textarea name="catatan_admin" rows="2" maxlength="1000"
                                                  class="form-control mb-2"
                                                  placeholder="Catatan untuk pengguna..."></textarea>

                                        <button type="submit" class="btn btn-approve"
                                                onclick="return confirm('Yakin ingin menyetujui pengajuan ini?')">
                                            ✓ Setujui Pengajuan
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.restock.reject', $item->id) }}"
                                          class="border-t border-gray-100 pt-3">
                                        @csrf
                                        @method('PATCH')

                                        <label class="block text-xs text-gray-500 mb-1">Alasan penolakan (wajib)</label>
                                        <textarea name="catatan_admin" rows="2" maxlength="1000" required
                                                  class="form-control mb-2"
                                                  placeholder="Tuliskan alasan penolakan..."></textarea>

                                        <button type="submit" class="btn btn-reject"
                                                onclick="return confirm('Yakin ingin menolak pengajuan ini?')">
                                            ✕ Tolak Pengajuan
                                        </button>
                                    </form>
                                @else
                                    <div class="rounded-lg bg-gray-50 border border-gray-200 p-3">
                                        <p class="text-xs font-semibold text-gray-600">Pengajuan sudah diproses</p>
                                        <p class="text-xs text-gray-400 mt-1">Tindakan tidak tersedia lagi.</p>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyDataRow">
                            <td colspan="8" class="px-6 py-14 text-center">
                                <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-[#f4eee9] brown flex items-center justify-center">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l3 3v15H6V3zM9 12h6M9 15h6"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-700">Belum Ada Pengajuan</h4>
                                <p class="text-sm text-gray-500 mt-2">
                                    Pengajuan restock dari pengguna akan muncul di halaman ini.
                                </p>
                            </td>
                        </tr>
                    @endforelse

                    <tr id="noSearchResult" class="hidden">
                        <td colspan="8" class="px-6 py-10 text-center text-gray-500">
                            Tidak ada pengajuan yang cocok dengan pencarian.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="px-5 py-4 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <p class="text-xs text-gray-500">
                Menampilkan <span id="visibleCount">{{ $requests->count() }}</span>
                dari {{ $requests->count() }} pengajuan.
            </p>
            <p class="text-xs text-gray-400">Book Stock SMKN 5 Kabupaten Tangerang</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-5 md:p-6 mt-6 shadow-sm">
        <h3 class="text-base font-bold brown mb-2">Informasi Pengelolaan Restock</h3>
        <p class="text-sm text-gray-600 leading-relaxed">
            Periksa judul buku, jumlah yang diajukan, dan alasan pengguna.
            Pengajuan berstatus Menunggu dapat disetujui atau ditolak.
            Jika menolak, admin wajib mengisi alasan agar pengguna mengetahui
            keputusan tersebut. Setelah diproses, status dan catatan admin
            akan ditampilkan pada tabel ini.
        </p>
    </div>

</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const rows = Array.from(document.querySelectorAll('.request-row'));
    const noSearchResult = document.getElementById('noSearchResult');
    const visibleCount = document.getElementById('visibleCount');

    function filterRequests() {
        const keyword = searchInput.value.toLowerCase().trim();
        const status = statusFilter.value.toLowerCase();
        let visible = 0;

        rows.forEach(function (row) {
            const matchesSearch = (row.dataset.search || '').includes(keyword);
            const matchesStatus = !status || row.dataset.status === status;
            const show = matchesSearch && matchesStatus;

            row.classList.toggle('hidden', !show);
            if (show) visible++;
        });

        visibleCount.textContent = visible;
        noSearchResult?.classList.toggle('hidden', rows.length === 0 || visible !== 0);
    }

    searchInput.addEventListener('input', filterRequests);
    statusFilter.addEventListener('change', filterRequests);
});
</script>
@endpush