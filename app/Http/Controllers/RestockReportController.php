<?php

namespace App\Http\Controllers;

use App\Models\RestockRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RestockReportController extends Controller
{
    /**
     * Nama kolom jumlah buku pada tabel pengajuan restock.
     * Ubah kalau di databasemu namanya berbeda (misalnya 'quantity').
     */
    private string $qtyColumn = 'jumlah';

    /**
     * Query dasar + filter (dipakai oleh tabel, ringkasan, dan PDF).
     */
    private function filteredQuery(Request $request)
    {
        return RestockRequest::query()
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when($request->filled('dari'), function ($q) use ($request) {
                $q->whereDate('created_at', '>=', $request->dari);
            })
            ->when($request->filled('sampai'), function ($q) use ($request) {
                $q->whereDate('created_at', '<=', $request->sampai);
            })
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->whereHas('book', function ($b) use ($request) {
                    $b->where('title', 'like', '%' . $request->search . '%');
                });
            });
    }

    public function index(Request $request)
    {
        $base = $this->filteredQuery($request);

        // Ringkasan laporan (mengikuti filter)
        $totalPengajuan = (clone $base)->count();
        $totalJumlah    = (clone $base)->sum($this->qtyColumn);

        // Jumlah per status, otomatis mengikuti status yang ada di database
        $statusCounts = (clone $base)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        // Pilihan status untuk dropdown filter
        $statusOptions = RestockRequest::query()
            ->select('status')
            ->distinct()
            ->orderBy('status')
            ->pluck('status');

        // Data tabel
        $restocks = $base->with('book.category')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('restocks.report', compact(
            'restocks',
            'totalPengajuan',
            'totalJumlah',
            'statusCounts',
            'statusOptions'
        ));
    }

    /**
     * Mengunduh laporan restock dalam bentuk PDF.
     * Mengikuti filter yang sedang dipilih, dan memuat SEMUA data (tanpa pagination).
     */
    public function exportPdf(Request $request)
    {
        $restocks = $this->filteredQuery($request)
            ->with('book.category')
            ->latest()
            ->get();

        $totalPengajuan = $restocks->count();
        $totalJumlah    = $restocks->sum($this->qtyColumn);
        $statusCounts   = $restocks->groupBy('status')->map->count();

        $pdf = Pdf::loadView('restocks.report-pdf', [
            'restocks'       => $restocks,
            'totalPengajuan' => $totalPengajuan,
            'totalJumlah'    => $totalJumlah,
            'statusCounts'   => $statusCounts,
            'filters'        => $request->only(['search', 'status', 'dari', 'sampai']),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('laporan-restock-' . now()->format('Y-m-d') . '.pdf');
    }
}