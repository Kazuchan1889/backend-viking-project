<?php

namespace App\Http\Controllers\Api\Donation;

use App\Http\Controllers\Controller;
use App\Models\Donation\SeassonPassDonation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; 
use Illuminate\Support\Facades\Storage; // <-- UNCOMMENTED: Added Storage facade for file operations

class SeassonPassDonationController extends Controller
{
    public function index(): JsonResponse
    {
        $info = SeassonPassDonation::all();
        return response()->json($info);
    }

    public function show($id):JsonResponse
    {
        $info = SeassonPassDonation::find($id);
        if (!$info) {
            return response()->json(['message' => 'description is not found'], 404);
        }
        return response()->json($info);
    }

    public function store(Request $request):JsonResponse
    {
        $validated = $request->validate([
            'donation_informations_id' => 'required|exists:donation_informations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'pricing' => 'required|string',
            'image' => 'required|file|image|mimes:jpg,jpeg,png|', 
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/gems', $filename); // Stores in storage/app/public/gems
            $validated['image'] = $filename; // Saves only the filename to the database
        }


        $info = SeassonPassDonation::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id):JsonResponse
    {
        $info = SeassonPassDonation::findOrFail($id);

        $validated = $request->validate([
            'donation_informations_id' => 'required|exists:donation_informations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'pricing' => 'required|string',
            'image' => 'required|file|image|mimes:jpg,jpeg,png|', 

        ]);

        // ACTIVATED: Logic for storing and optionally deleting old image file
        if ($request->hasFile('image')) {
            // Delete old file if it exists
            if ($info->image && Storage::exists('public/gems/' . $info->image)) {
                Storage::delete('public/gems/' . $info->image);
            }
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/gems', $filename);
            $validated['image'] = $filename; // Saves only the filename to the database
        }


        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id):JsonResponse
    {
        $info = SeassonPassDonation::findOrFail($id);
        // ACTIVATED: Logic to delete the image file when the record is destroyed
        if ($info->image && Storage::exists('public/gems/' . $info->image)) {
            Storage::delete('public/gems/' . $info->image);
        }
        $info->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
