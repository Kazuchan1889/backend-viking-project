<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\DropList\ElfLand;
use Illuminate\Http\Request;

class ElfLandController extends Controller
{
    public function index()
    {
        $npcs = ElfLand::all();
        return response()->json($npcs);
    }

    public function show($id)
    {
        $npc = ElfLand::find($id);
        if (!$npc) {
            return response()->json(['message' => 'description is not found'], 404);
        }
        return response()->json($npc);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_information_id' => 'required|exists:game_infos,id',
            'title' => 'required|string|max:255',     // lowercase key untuk konsistensi
            'description' => 'required|string',
        ]);

        $npc = ElfLand::create($validated);
        return response()->json($npc, 201);
    }

    public function update(Request $request, $id)
    {
        $npc = ElfLand::findOrFail($id);

        $validated = $request->validate([
            'game_information_id' => 'required|exists:game_infos,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $npc->update($validated);
        return response()->json($npc);
    }

    public function destroy($id)
    {
        $npc = ElfLand::findOrFail($id);
        $npc->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
