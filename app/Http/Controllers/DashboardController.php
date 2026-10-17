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

        // Total buku
        $totalBuku = Book::count();

        // Dashboard Admin
        if ($user->role === 'admin') {
            $totalStok = Book::sum('stock');

            // Total pengajuan restock
            $totalPengajuan = RestockRequest::count();

            // Pengajuan yang masih menunggu
            $totalMenunggu = RestockRequest::where(
                'status',
                'menunggu'
            )->count();

            // Pengajuan terbaru untuk tabel dashboard admin
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
                'pengajuanTerbaru'
            ));
        }

        // Dashboard User
        $totalPengajuan = RestockRequest::where(
            'user_id',
            $user->id
        )->count();

        $totalMenunggu = RestockRequest::where('user_id', $user->id)
            ->where('status', 'menunggu')
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
            'pengajuanTerbaru'
        ));
    }
}