<?php

namespace App\Http\Controllers\Api\Donation;

use App\Http\Controllers\Controller;
use App\Models\Donation\DonationInformation;
use Illuminate\Http\Request;

class DonationInformationController extends Controller
{
    public function index()
    {
        $info = DonationInformation::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = DonationInformation::find($id);
        if (!$info) {
            return response()->json(['message' => 'Donation Information not found'], 404);
        }
        return response()->json($info);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:donation_informations,name',
        ]);

        $info = DonationInformation::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = DonationInformation::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:donation_informations,name,' . $id,
        ]);

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        $info = DonationInformation::findOrFail($id);
        $info->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}