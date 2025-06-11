<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\NPCList\ElanPlateauNpc;
use Illuminate\Http\Request;

class ElanPlateauNpcController extends Controller
{
    public function index()
    {
        $npcs = ElanPlateauNpc::all();
        return response()->json($npcs);
    }

    public function show($id)
    {
        $npc = ElanPlateauNpc::find($id);
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

        $npc = ElanPlateauNpc::create($validated);
        return response()->json($npc, 201);
    }

    public function update(Request $request, $id)
    {
        $npc = ElanPlateauNpc::findOrFail($id);

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
        $npc = ElanPlateauNpc::findOrFail($id);
        $npc->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
