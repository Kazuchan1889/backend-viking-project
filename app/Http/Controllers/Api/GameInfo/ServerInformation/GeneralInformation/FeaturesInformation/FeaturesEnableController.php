<?php
namespace App\Http\Controllers\Api\GameInfo\ServerInformation\GeneralInformation\FeaturesInformation;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo\FeaturesEnable;
use Illuminate\Http\Request;

class FeaturesEnableController extends Controller
{
    public function index()
    {
        $features = FeaturesEnable::all();
        return response()->json($features);
    }

    public function show($id)
    {
        $feature = FeaturesEnable::find($id);
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

        $feature = FeaturesEnable::create($validated);
        return response()->json($feature, 201);
    }

    public function update(Request $request, $id)
    {
        $feature = FeaturesEnable::findOrFail($id);

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
        $feature = FeaturesEnable::findOrFail($id);
        $feature->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
