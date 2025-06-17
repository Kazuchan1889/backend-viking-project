<?php

namespace App\Http\Controllers\Api\GameInfo\ServerInformation\GeneralInformation;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\GeneralInfo\SystemInformation;
use Illuminate\Http\Request;

class SystemInformationController extends Controller
{
    public function index()
    {
        $data = SystemInformation::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'system_info' => 'required|string',
            'description' => 'required|string',
        ]);

        $feature = SystemInformation::create($validated);
        return response()->json($feature, 201);
    }

    public function update(Request $request, $id)
    {
        $feature = SystemInformation::findOrFail($id);

        $validated = $request->validate([
            'server_info' => 'required|string',
            'description' => 'required|string',
        ]);

        $feature->update($validated);
        return response()->json($feature);
    }

    public function destroy($id)
    {
        $feature = SystemInformation::findOrFail($id);
        $feature->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
