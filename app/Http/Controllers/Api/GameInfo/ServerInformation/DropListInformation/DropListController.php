<?php

namespace App\Http\Controllers\Api\GameInfo\ServerInformation\DropListInformation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GameInfo\ServerInfo\DropList\DropList; 
use App\Models\GameInfo\Items;

class DropListController extends Controller
{
    // Ambil semua Drop List
    public function index()
    {
        $dropLists = DropList::with(['mapInformation', 'item'])->get(); 
        return response()->json($dropLists);
    }

    // Simpan Drop List baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'monster' => 'required|string',
            'items_id' => 'required|exists:items,id', 
            'map_information_id' => 'required|exists:map_informations,id', 
        ]);

        $dropList = DropList::create($validated);
        return response()->json($dropList, 201);
    }

    public function show($id)
    {
        $dropList = DropList::with(['mapInformation', 'item'])->findOrFail($id); // Eager load relationships
        return response()->json($dropList);
    }

    public function update(Request $request, $id)
    {
        $dropList = DropList::findOrFail($id);

        $validated = $request->validate([
            'monster' => 'sometimes|required|string', 
            'items_id' => 'sometimes|required|exists:items,id',
            'map_information_id' => 'sometimes|required|exists:map_informations,id',
        ]);

        $dropList->update($validated);
        return response()->json($dropList);
    }

    public function destroy($id)
    {
        $dropList = DropList::findOrFail($id);
        $dropList->delete();

        return response()->json(['message' => 'Drop list deleted successfully.']);
    }
}