<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerRules;
use Illuminate\Http\Request;

class ServerRulesController extends Controller
{
    public function index()
    {
        $info = ServerRules::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = ServerRules::find($id);
        if (!$info) {
            return response()->json(['message' => 'description is not found'], 404);
        }
        return response()->json($info);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_info_id' => 'required|exists:game_info,id',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $info = ServerRules::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = ServerRules::findOrFail($id);

        $validated = $request->validate([
            'game_info_id' => 'required|exists:game_info,id',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        $info = ServerRules::findOrFail($id);
        $info->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
