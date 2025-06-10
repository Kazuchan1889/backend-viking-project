<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\FeatureInfo\PendantInformation;
use Illuminate\Http\Request;

class PendantInformationController extends Controller
{
    public function index()
    {
        $info = PendantInformation::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = PendantInformation::find($id);
        if (!$info) {
            return response()->json(['message' => 'Description not found'], 404);
        }
        return response()->json($info);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'feature_information_id' => 'required|exists:feature_information,id',
            'image' => 'required|string',
            'name_item' => 'required|string',
            'type' => 'required|string',
            'trade' => 'required|string',
        ]);

        $info = PendantInformation::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = PendantInformation::findOrFail($id);

        $validated = $request->validate([
            'feature_information_id' => 'required|exists:feature_information,id',
            'image' => 'required|string',
            'name_item' => 'required|string',
            'type' => 'required|string',
            'trade' => 'required|string',
        ]);

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        PendantInformation::findOrFail($id)->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
