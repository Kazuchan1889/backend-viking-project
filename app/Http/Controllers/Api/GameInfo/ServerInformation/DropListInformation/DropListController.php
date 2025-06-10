<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\DropList\DropList;
use App\Models\GameInfo\ServerInfo\DropList\DropOnHq;

class DropListController extends Controller
{
    public function index()
    {
        // Memuat semua DropList beserta relasi DropOnHq
        $data = DropList::with('dropOnHq')->get();
        return response()->json($data);
    }

    public function dropOnOnly()
    {
        // Ambil semua data drop khusus HQ langsung
        $data = DropOnHq::all();
        return response()->json($data);
    }
}
