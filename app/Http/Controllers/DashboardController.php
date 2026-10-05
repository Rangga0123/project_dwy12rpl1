<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        // Ambil total buku (bisa dipakai admin dan user)
        $totalBuku = Book::count();

        // Dashboard Admin
        if ($user->role === 'admin') {
            $totalStok = Book::sum('stock');
            return view('Admin.dashboard', compact('totalBuku', 'totalStok'));
        }

        // Dashboard User
        return view('user.dashboard', compact('totalBuku'));
    }
}