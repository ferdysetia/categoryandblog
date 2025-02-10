<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Tampilkan halaman dashboard
        return view('dashboard');
    }
}
