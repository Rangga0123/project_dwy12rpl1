<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Dashboard Admin
        if ($user->role === 'admin') {
            return view('Admin.dashboard');
        }

        // Dashboard User
        return view('user.dashboard');
    }
}