<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class Catatan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }
    public function show(Laporan $catatan)
    {
        return response()->json(['pencarian_data' => $catatan]);
    }

    
}
