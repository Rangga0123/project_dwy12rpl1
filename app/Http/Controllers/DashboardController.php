<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\RestockRequest;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $totalBuku = Book::count();

        // =========================
        // DASHBOARD ADMIN
        // =========================
        if ($user->role === 'admin') {

            $totalStok = Book::sum('stock');

            // Total seluruh pengajuan
            $totalPengajuan = RestockRequest::count();

            // Pengajuan menunggu
            $totalMenunggu = RestockRequest::where(
                'status',
                'menunggu'
            )->count();

            // Pengajuan disetujui dihitung sebagai restock selesai
            $totalRestockSelesai = RestockRequest::where(
                'status',
                'disetujui'
            )->count();

            // Pengajuan ditolak
            $totalDitolak = RestockRequest::where(
                'status',
                'ditolak'
            )->count();

            // Lima pengajuan terbaru
            $pengajuanTerbaru = RestockRequest::with([
                'book',
                'user'
            ])
                ->latest()
                ->take(5)
                ->get();

            return view('Admin.dashboard', compact(
                'totalBuku',
                'totalStok',
                'totalPengajuan',
                'totalMenunggu',
                'totalRestockSelesai',
                'totalDitolak',
                'pengajuanTerbaru'
            ));
        }

        // =========================
        // DASHBOARD USER
        // =========================

        $totalPengajuan = RestockRequest::where(
            'user_id',
            $user->id
        )->count();

        $totalMenunggu = RestockRequest::where(
            'user_id',
            $user->id
        )
            ->where('status', 'menunggu')
            ->count();

        $totalDisetujui = RestockRequest::where(
            'user_id',
            $user->id
        )
            ->where('status', 'disetujui')
            ->count();

        $totalDitolak = RestockRequest::where(
            'user_id',
            $user->id
        )
            ->where('status', 'ditolak')
            ->count();

        $pengajuanTerbaru = RestockRequest::with('book')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'totalBuku',
            'totalPengajuan',
            'totalMenunggu',
            'totalDisetujui',
            'totalDitolak',
            'pengajuanTerbaru'
        ));
    }
}
