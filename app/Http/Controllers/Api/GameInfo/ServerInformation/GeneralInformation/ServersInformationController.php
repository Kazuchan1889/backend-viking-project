<?php

namespace App\Http\Controllers\Api\GameInfo\ServerInformation\GeneralInformation;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\GeneralInfo\ServersInformation;
use Illuminate\Http\Request;
use App\Models\GameInfo\GameInformation; 

class ServersInformationController extends Controller
{
    public function index()
    {
        $features = ServersInformation::with('gameInformation')->get(); 
        return response()->json($features);
    }

    public function show($id)
    {
        $feature = ServersInformation::with('gameInformation')->find($id); 
        if (!$feature) {
            return response()->json(['message' => 'Feature not found'], 404);
        }
        return response()->json($feature);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_information_id' => 'required|exists:game_informations,id',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $feature = ServersInformation::create($validated);
        return response()->json($feature, 201);
    }

    public function update(Request $request, $id)
    {
        $feature = ServersInformation::findOrFail($id);

        $validated = $request->validate([
            'game_information_id' => 'required|exists:game_informations,id',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $feature->update($validated);
        return response()->json($feature);
    }

    public function destroy($id)
    {
        $feature = ServersInformation::findOrFail($id);
        $feature->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
