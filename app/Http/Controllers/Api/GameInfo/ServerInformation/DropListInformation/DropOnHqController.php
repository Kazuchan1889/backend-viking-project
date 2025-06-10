<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\DropList\DropOnHq;
use Illuminate\Http\Request;

class DropOnHqController extends Controller
{
    public function index()
    {
        $npcs = DropOnHq::all();
        return response()->json($npcs);
    }

    public function show($id)
    {
        $npc = DropOnHq::find($id);
        if (!$npc) {
            return response()->json(['message' => 'description is not found'], 404);
        }
        return response()->json($npc);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'drop_list_id' => 'required|exists:drop_lists,id',
            'title' => 'required|string|max:255',     // lowercase key untuk konsistensi
            'description' => 'required|string',
        ]);

        $npc = DropOnHq::create($validated);
        return response()->json($npc, 201);
    }

    public function update(Request $request, $id)
    {
        $npc = DropOnHq::findOrFail($id);

        $validated = $request->validate([
            'drop_list_id' => 'required|exists:drop_lists,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $npc->update($validated);
        return response()->json($npc);
    }

    public function destroy($id)
    {
        $npc = DropOnHq::findOrFail($id);
        $npc->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
