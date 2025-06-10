<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\MapInformation;
use Illuminate\Http\Request;

class MapInformationController extends Controller
{
    public function index()
    {
        $info = MapInformation::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = MapInformation::find($id);
        if (!$info) {
            return response()->json(['message' => 'Description not found'], 404);
        }
        return response()->json($info);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_info_id' => 'required|exists:game_info,id',
            'location_name' => 'required|string',
            'image' => 'required|string',
        ]);

        $info = MapInformation::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = MapInformation::findOrFail($id);

        $validated = $request->validate([
            'game_info_id' => 'sometimes|required|exists:game_info,id',
            'location_name' => 'sometimes|required|string',
            'image' => 'sometimes|required|string',
        ]);

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        $info = MapInformation::findOrFail($id);
        $info->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
