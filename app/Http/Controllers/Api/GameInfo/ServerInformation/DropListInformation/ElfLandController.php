<?php

namespace App\Http\Controllers\Api\GameInfo\ServerInformation\DropListInformation;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\DropList\ElfLand;
use Illuminate\Http\Request;

class ElfLandController extends Controller
{
    public function index()
    {
        $droplists = ElfLand::all();
        return response()->json($droplists);
    }

    public function show($id)
    {
        $droplist = ElfLand::find($id);
        if (!$droplist) {
            return response()->json(['message' => 'DropList is not found'], 404);
        }
        return response()->json($droplist);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_information_id' => 'required|exists:game_informations,id',
            'title' => 'required|string|max:255',     // lowercase key untuk konsistensi
            'description' => 'required|string',
        ]);

        $droplist = ElfLand::create($validated);
        return response()->json($droplist, 201);
    }

    public function update(Request $request, $id)
    {
        $droplist = ElfLand::findOrFail($id);

        $validated = $request->validate([
            'game_information_id' => 'required|exists:game_informations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $droplist->update($validated);
        return response()->json($droplist);
    }

    public function destroy($id)
    {
        $droplist = ElfLand::findOrFail($id);
        $droplist->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
