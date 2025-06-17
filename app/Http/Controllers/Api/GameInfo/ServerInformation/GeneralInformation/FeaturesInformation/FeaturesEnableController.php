<?php

namespace App\Http\Controllers\Api\GameInfo\ServerInformation\GeneralInformation\FeaturesInformation;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo\FeaturesEnable;
use Illuminate\Http\Request;

class FeaturesEnableController extends Controller
{
    // Menampilkan seluruh fitur
    public function index()
    {
        $features = FeaturesEnable::all();
        return response()->json($features);
    }

    // Menyimpan data fitur baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'feature' => 'required|string',
            'description' => 'required|string',
        ]);

        $feature = FeaturesEnable::create($validated);
        return response()->json($feature, 201);
    }

    // Memperbarui data fitur berdasarkan ID
    public function update(Request $request, $id)
    {
        $feature = FeaturesEnable::findOrFail($id);

        $validated = $request->validate([
            'feature' => 'required|string',
            'description' => 'required|string',
        ]);

        $feature->update($validated);
        return response()->json($feature);
    }

    // Menghapus data fitur berdasarkan ID
    public function destroy($id)
    {
        $feature = FeaturesEnable::findOrFail($id);
        $feature->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
