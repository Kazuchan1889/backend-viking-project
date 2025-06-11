<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\DropList\VolcanicCauldron;
use Illuminate\Http\Request;

class VolcanicCauldronController extends Controller
{
    public function index()
    {
        $npcs = VolcanicCauldron::all();
        return response()->json($npcs);
    }

    public function show($id)
    {
        $npc = VolcanicCauldron::find($id);
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

        $npc = VolcanicCauldron::create($validated);
        return response()->json($npc, 201);
    }

    public function update(Request $request, $id)
    {
        $npc = VolcanicCauldron::findOrFail($id);

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
        $npc = VolcanicCauldron::findOrFail($id);
        $npc->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
