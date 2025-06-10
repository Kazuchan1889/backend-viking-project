<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo\FeaturesDisable;
use Illuminate\Http\Request;

class FeaturesDisableController extends Controller
{
    // Tampilkan semua fitur yang dinonaktifkan
    public function index()
    {
        $features = FeaturesDisable::all();
        return response()->json($features);
    }

    // Tampilkan satu fitur berdasarkan ID
    public function show($id)
    {
        $feature = FeaturesDisable::find($id);
        if (!$feature) {
            return response()->json(['message' => 'Feature not found'], 404);
        }
        return response()->json($feature);
    }

    // Tambahkan fitur disable baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'general_information_id' => 'required|exists:general_informations,id',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $feature = FeaturesDisable::create($validated);
        return response()->json($feature, 201);
    }

    // Perbarui fitur disable
    public function update(Request $request, $id)
    {
        $feature = FeaturesDisable::findOrFail($id);

        $validated = $request->validate([
            'general_information_id' => 'required|exists:general_informations,id',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $feature->update($validated);
        return response()->json($feature);
    }

    // Hapus fitur disable
    public function destroy($id)
    {
        $feature = FeaturesDisable::findOrFail($id);
        $feature->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
