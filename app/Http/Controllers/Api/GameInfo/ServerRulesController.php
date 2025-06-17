<?php

namespace App\Http\Controllers\Api\GameInfo;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerRules;
use Illuminate\Http\Request;

class ServerRulesController extends Controller
{
    public function index()
    {
        $servers = ServerRules::all();
        return response()->json($servers);
    }

    public function show($id)
    {
        $server = ServerRules::find($id);
        if (!$server) {
            return response()->json(['message' => 'Server is not found'], 404);
        }
        return response()->json($server);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rules' => 'required|string|max:255',    
            'category' => 'required|string',
            'description' => 'required|string',
        ]);

        $server= ServerRules::create($validated);
        return response()->json($server, 201);
    }

    public function update(Request $request, $id)
    {
        $server = ServerRules::findOrFail($id);

        $validated = $request->validate([
            'rules' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
        ]);

        $server->update($validated);
        return response()->json($server);
    }

    public function destroy($id)
    {
        $server = ServerRules::findOrFail($id);
        $server->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
