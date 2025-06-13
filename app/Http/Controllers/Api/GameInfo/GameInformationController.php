<?php

namespace App\Http\Controllers\Api\GameInfo;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\GameInformation; 
use Illuminate\Http\Request;

class GameInformationController extends Controller
{
    public function index()
    {
        $info = GameInformation::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = GameInformation::find($id);
        if (!$info) {
            return response()->json(['message' => 'Game Information not found'], 404);
        }
        return response()->json($info);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:game_informations,name', // Pastikan nama unik
        ]);

        $info = GameInformation::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = GameInformation::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:game_informations,name,' . $id,
        ]);

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        $info = GameInformation::findOrFail($id);
        $info->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}