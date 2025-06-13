<?php

namespace App\Http\Controllers\Api\GameInfo\ServerInformation\FeatureInformation;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\FeatureInfo\GemInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- UNCOMMENTED: Added Storage facade for file operations

class GemInformationController extends Controller
{
    public function index()
    {
        $info = GemInformation::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = GemInformation::find($id);
        if (!$info) {
            return response()->json(['message' => 'description is not found'], 404);
        }
        return response()->json($info);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_information_id' => 'required|exists:game_informations,id',
            'image' => 'required|file|image|mimes:jpg,jpeg,png|max:2048', 
            'name_item' => 'required|string',
            'type' => 'required|string',
            'trade' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/gems', $filename); // Stores in storage/app/public/gems
            $validated['image'] = $filename; // Saves only the filename to the database
        }


        $info = GemInformation::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = GemInformation::findOrFail($id);

        $validated = $request->validate([
            'game_information_id' => 'required|exists:game_informations,id',
            // MODIFIED: Changed validation to allow nullable file upload for images
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png|max:2048', 
            'name_item' => 'required|string',
            'type' => 'required|string',
            'trade' => 'required|string',

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

    public function destroy($id)
    {
        $info = GemInformation::findOrFail($id);
        // ACTIVATED: Logic to delete the image file when the record is destroyed
        if ($info->image && Storage::exists('public/gems/' . $info->image)) {
            Storage::delete('public/gems/' . $info->image);
        }
        $info->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
