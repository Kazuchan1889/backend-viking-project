<?php

namespace App\Http\Controllers\Api\GameInfo\ServerInformation\GeneralInformation;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\GeneralInfo\ServersInformation;
use Illuminate\Http\Request;

class ServersInformationController extends Controller
{
    public function index()
    {
        $data = ServersInformation::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'server_info' => 'required|string',
            'description' => 'required|string',
        ]);

        $feature = ServersInformation::create($validated);
        return response()->json($feature, 201);
    }

    public function update(Request $request, $id)
    {
        $feature = ServersInformation::findOrFail($id);

        $validated = $request->validate([
            'server_info' => 'required|string',
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
