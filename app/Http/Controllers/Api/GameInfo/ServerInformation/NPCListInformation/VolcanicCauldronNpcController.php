<?php

namespace App\Http\Controllers\Api\GameInfo\ServerInformation\NPCListInformation;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\NPCList\VolcanicCauldronNpc;
use Illuminate\Http\Request;

class VolcanicCauldronNpcController extends Controller
{
    public function index()
    {
        $npcs = VolcanicCauldronNpc::all();
        return response()->json($npcs);
    }

    public function show($id)
    {
        $npc = VolcanicCauldronNpc::find($id);
        if (!$npc) {
            return response()->json(['message' => 'NPC is not found'], 404);
        }
        return response()->json($npc);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_information_id' => 'required|exists:game_informations,id',
            'npc' => 'required|string|max:255',     // lowercase key untuk konsistensi
            'buy_with' => 'required|string',
        ]);

        $npc = VolcanicCauldronNpc::create($validated);
        return response()->json($npc, 201);
    }

    public function update(Request $request, $id)
    {
        $npc = VolcanicCauldronNpc::findOrFail($id);

        $validated = $request->validate([
            'game_information_id' => 'required|exists:game_informations,id',
            'npc' => 'required|string|max:255',
            'buy_with' => 'required|string',
        ]);

        $npc->update($validated);
        return response()->json($npc);
    }

    public function destroy($id)
    {
        $npc = VolcanicCauldronNpc::findOrFail($id);
        $npc->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
