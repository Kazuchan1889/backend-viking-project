<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donation\SeassonPassDonation;
use Illuminate\Http\Request;

class SeassonPassDonationController extends Controller
{
    public function index()
    {
        $info = SeassonPassDonation::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = SeassonPassDonation::find($id);
        if (!$info) {
            return response()->json(['message' => 'description is not found'], 404);
        }
        return response()->json($info);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'donation_id' => 'required|exists:donations,id',
            'title' => 'required|string',
            'pricing' => 'required|integer',
            'timestamps' => 'required|date_format:Y-m-d H:i:s'
        ]);

        $info = SeassonPassDonation::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = SeassonPassDonation::findOrFail($id);

        $validated = $request->validate([
            'donation_id' => 'required|exists:donations,id',
            'title' => 'required|string',
            'pricing' => 'required|integer',
            'timestamps' => 'required|date_format:Y-m-d H:i:s'
        ]);

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        $info = SeassonPassDonation::findOrFail($id);
        $info->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
