<?php

namespace App\Http\Controllers\Api\Donation;

use App\Http\Controllers\Controller;
use App\Models\Donation\SeassonPassDonation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; 
use Illuminate\Support\Facades\Storage; 

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
            $path = $request->file('image')->storeAs('public/seassonpass', $filename); // Stores in storage/app/public/gems
            $validated['image'] = $filename; 
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

        if ($request->hasFile('image')) {
            if ($info->image && Storage::exists('public/seassonpass/' . $info->image)) {
                Storage::delete('public/seassonpass/' . $info->image);
            }
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/seassonpass', $filename);
            $validated['image'] = $filename;
        }


        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id):JsonResponse
    {
        $info = SeassonPassDonation::findOrFail($id);
        if ($info->image && Storage::exists('public/seassonpass/' . $info->image)) {
            Storage::delete('public/seassonpass/' . $info->image);
        }
        $info->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
