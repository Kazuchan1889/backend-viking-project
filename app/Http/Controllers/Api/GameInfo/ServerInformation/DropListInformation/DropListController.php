<?php

namespace App\Http\Controllers\Api\GameInfo\ServerInformation\DropListInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GameInfo\ServerInfo\DropList\DropList;
use App\Models\GameInfo\MapInformation;

class DropListController extends Controller
{
    // Ambil semua NPC
    public function index()
    {
        $npcLists = DropList::with('mapInformation')->get();
        return response()->json($npcLists);
    }

    // Simpan NPC baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'droplist' => 'required|string',
            'buy_with' => 'required|string',
            'map_information_id' => 'required|exists:map_informations,id',
        ]);

        $npc = DropList::create($validated);
        return response()->json($npc, 201);
    }

    // Tampilkan detail NPC tertentu
    public function show($id)
    {
        $npc = DropList::with('mapInformation')->findOrFail($id);
        return response()->json($npc);
    }

    // Update NPC
    public function update(Request $request, $id)
    {
        $npc = DropList::findOrFail($id);

        $validated = $request->validate([
            'droplist' => 'sometimes|required|string',
            'buy_with' => 'sometimes|required|string',
            'map_information_id' => 'sometimes|required|exists:map_informations,id',
        ]);

        $npc->update($validated);
        return response()->json($npc);
    }

    // Hapus NPC
    public function destroy($id)
    {
        $npc = DropList::findOrFail($id);
        $npc->delete();

        return response()->json(['message' => 'NPC deleted successfully.']);
    }
}
