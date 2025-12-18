<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LogPerhitungan;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Show a public dashboard for guest users.
     * It displays system logs or any data that should be visible to unauthenticated visitors.
     */
    public function dashboard()
    {
        // Retrieve recent logs – you can adjust the query as needed.
        $logs = LogPerhitungan::orderBy('created_at', 'desc')->take(20)->get();
        return view('guest.dashboard', compact('logs'));
    }
}
