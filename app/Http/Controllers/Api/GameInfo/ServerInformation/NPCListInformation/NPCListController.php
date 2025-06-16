<?php

namespace App\Http\Controllers\Api\GameInfo\ServerInformation\NPCListInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GameInfo\ServerInfo\NPCList\NpcList;
use App\Models\GameInfo\MapInformation;

class NpcListController extends Controller
{
    // Ambil semua NPC
    public function index()
    {
        $npcLists = NpcList::with('mapInformation')->get();
        return response()->json($npcLists);
    }

    // Simpan NPC baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'npc' => 'required|string',
            'buy_with' => 'required|string',
            'map_information_id' => 'required|exists:map_informations,id',
        ]);

        $npc = NpcList::create($validated);
        return response()->json($npc, 201);
    }

    // Tampilkan detail NPC tertentu
    public function show($id)
    {
        $npc = NpcList::with('mapInformation')->findOrFail($id);
        return response()->json($npc);
    }

    // Update NPC
    public function update(Request $request, $id)
    {
        $npc = NpcList::findOrFail($id);

        $validated = $request->validate([
            'npc' => 'sometimes|required|string',
            'buy_with' => 'sometimes|required|string',
            'map_information_id' => 'sometimes|required|exists:map_informations,id',
        ]);

        $npc->update($validated);
        return response()->json($npc);
    }

    // Hapus NPC
    public function destroy($id)
    {
        $npc = NpcList::findOrFail($id);
        $npc->delete();

        return response()->json(['message' => 'NPC deleted successfully.']);
    }
}
