<?php

namespace App\Http\Controllers\Api\Donation;

use App\Http\Controllers\Controller;
use App\Models\Donation\PackageDonation;
use Illuminate\Http\Request;

class PackageDonationController extends Controller
{
    public function index()
    {
        $info = PackageDonation::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = PackageDonation::find($id);
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
            'description' => 'nullable|string',
            'pricing' => 'required|integer',
            'timestamps' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $info = PackageDonation::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = PackageDonation::findOrFail($id);

        $validated = $request->validate([
            'donation_id' => 'required|exists:donations,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'pricing' => 'required|integer',
            'timestamps' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        $info = PackageDonation::findOrFail($id);
        $info->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
