<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\ServerInformationGameInfo;
use Illuminate\Http\Request;

class ServerInformationController extends Controller
{
    public function index()
    {
        // Ambil semua data ServerInformation beserta relasi-relasinya
        $serverinfo = ServerInformationGameInfo::with([
            'FeatureInformation',    // Nama method relasi di model
            'GeneralInformation',        // Nama method relasi di model
            'NPCList',            // Nama method relasi di model
            'DropList'        // Nama method relasi di model
        ])->get();

        return response()->json($serverinfo);
    }

    public function show($id)
    {
        $serverinfo = ServerInformationGameInfo::with([
            'FeatureInformation',    // Nama method relasi di model
            'GeneralInformation',        // Nama method relasi di model
            'NPCList',            // Nama method relasi di model
            'DropList'
        ])->findOrFail($id);

        return response()->json($serverinfo);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            // Tambahkan field lain jika dibutuhkan
        ]);

        $serverinfo = ServerInformationGameInfo::create($validated);

        return response()->json($serverinfo, 201);
    }

    public function update(Request $request, $id)
    {
        $serverinfo = ServerInformationGameInfo::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            // Tambahkan field lain jika dibutuhkan
        ]);

        $serverinfo->update($validated);

        return response()->json($serverinfo);
    }

    public function destroy($id)
    {
        ServerInformationGameInfo::findOrFail($id)->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
