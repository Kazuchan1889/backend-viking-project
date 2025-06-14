<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\FeatureInfo\FeatureInformation;
use Illuminate\Http\Request;

class FeatureInformationController extends Controller
{
    public function index()
    {
        $questinfo = FeatureInformation::with([
            'PendantInformation',
            'GemInformation'
        ])->get();

        return response()->json($questinfo);
    }

    public function show($id)
    {
        $questinfo = FeatureInformation::with([
            'PendantInformation',
            'GemInformation'
        ])->findOrFail($id);

        return response()->json($questinfo);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $questinfo = FeatureInformation::create($validated);

        return response()->json($questinfo, 201);
    }

    public function update(Request $request, $id)
    {
        $questinfo = FeatureInformation::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
        ]);

        $questinfo->update($validated);

        return response()->json($questinfo);
    }

    public function destroy($id)
    {
        FeatureInformation::findOrFail($id)->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
