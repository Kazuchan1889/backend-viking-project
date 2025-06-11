<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\NPCList\SetteDessertNpc;
use Illuminate\Http\Request;

class SetteDesertNpcController extends Controller
{
    public function index()
    {
        $npcs = SetteDessertNpc::all();
        return response()->json($npcs);
    }

    public function show($id)
    {
        $npc = SetteDessertNpc::find($id);
        if (!$npc) {
            return response()->json(['message' => 'NPC is not found'], 404);
        }
        return response()->json($npc);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_information_id' => 'required|exists:game_infos,id',
            'npc' => 'required|string|max:255',     // lowercase key untuk konsistensi
            'buy_with' => 'required|string',
        ]);

        $npc = SetteDessertNpc::create($validated);
        return response()->json($npc, 201);
    }

    public function update(Request $request, $id)
    {
        $npc = SetteDessertNpc::findOrFail($id);

        $validated = $request->validate([
            'game_information_id' => 'required|exists:game_infos,id',
            'npc' => 'required|string|max:255',
            'buy_with' => 'required|string',
        ]);

        $npc->update($validated);
        return response()->json($npc);
    }

    public function destroy($id)
    {
        $npc = SetteDessertNpc::findOrFail($id);
        $npc->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
