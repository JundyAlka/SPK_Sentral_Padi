<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use Illuminate\Http\Request;

class GuestDaerahController extends Controller
{
    /**
     * Show public daerah list for guest users.
     * Only records where `is_public` is true are displayed.
     */
    public function index()
    {
        $daerahs = Daerah::where('is_public', true)->get();
        return view('guest.daerah.index', compact('daerahs'));
    }
}
