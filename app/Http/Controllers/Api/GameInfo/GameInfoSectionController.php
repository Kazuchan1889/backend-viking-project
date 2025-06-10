<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\GameInfoSection;
use Illuminate\Http\Request;

class GameInfoSectionController extends Controller
{
    public function index()
    {
        // Ambil semua GameInfo beserta relasi-relasi yang terkait
        $gameInfos = GameInfoSection::with([
            'ServerInformation',
            'QuestInformation',
        ])->get();

        return response()->json($gameInfos);
    }

    public function show($id)
    {
        $gameInfo = GameInfoSection::with([
            'ServerInformation',
            'QuestInformation',
        ])->findOrFail($id);

        return response()->json($gameInfo);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            // tambahkan field lain jika perlu
        ]);

        $gameInfo = GameInfoSection::create($validated);

        return response()->json($gameInfo, 201);
    }

    public function update(Request $request, $id)
    {
        $gameInfo = GameInfoSection::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            // tambahkan field lain jika perlu
        ]);

        $gameInfo->update($validated);

        return response()->json($gameInfo);
    }

    public function destroy($id)
    {
        $gameInfo = GameInfoSection::findOrFail($id);
        $gameInfo->delete();

        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
