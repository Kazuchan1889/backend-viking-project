<?php

namespace App\Http\Controllers\Api\GameInfo\ServerInformation\FeatureInformation;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\FeatureInfo\PendantInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendantInformationController extends Controller
{
    public function index()
    {
        $info = PendantInformation::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = PendantInformation::find($id);
        if (!$info) {
            return response()->json(['message' => 'Description not found'], 404);
        }
        return response()->json($info);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|file|image|mimes:jpg,jpeg,png|max:2048',
            'name_item' => 'required|string',
            'type' => 'required|string',
            'trade' => 'required|string',
        ]);

        // Simpan gambar ke storage
        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/pendants', $filename);
            $validated['image'] = $filename;
        }

        $info = PendantInformation::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = PendantInformation::findOrFail($id);

        $validated = $request->validate([
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png|max:2048',
            'name_item' => 'required|string',
            'type' => 'required|string',
            'trade' => 'required|string',
        ]);

        // Simpan gambar baru jika diupload
        if ($request->hasFile('image')) {
            // Hapus file lama jika perlu
            if ($info->image && Storage::exists('public/pendants/' . $info->image)) {
                Storage::delete('public/pendants/' . $info->image);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/pendants', $filename);
            $validated['image'] = $filename;
        }

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        $info = PendantInformation::findOrFail($id);

        // Hapus file image jika ada
        if ($info->image && Storage::exists('public/pendants/' . $info->image)) {
            Storage::delete('public/pendants/' . $info->image);
        }

        $info->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
