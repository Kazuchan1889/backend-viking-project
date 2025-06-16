<?php

namespace App\Http\Controllers\Api\GameInfo;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\MapInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MapInformationController extends Controller
{
    public function index()
    {
        $info = MapInformation::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = MapInformation::find($id);
        if (!$info) {
            return response()->json(['message' => 'Map information not found'], 404); // Pesan lebih spesifik
        }
        return response()->json($info);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_information_id' => 'required|integer|exists:game_informations,id',
            'map_name' => 'required|string|max:255',
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png,gif,svg', 
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/mapinfo', $filename); 
            $validated['image'] = $filename;
        } else {
            $validated['image'] = null; 
        }

        $info = MapInformation::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = MapInformation::findOrFail($id);

        $validated = $request->validate([
            'game_information_id' => 'required|integer|exists:game_informations,id', // Tambahkan 'integer'
            'map_name' => 'required|string|max:255', 
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png,gif,svg', // Ubah ke 'nullable' karena tidak selalu ada file baru
        ]);

        if ($request->has('image_removed') && $request->input('image_removed') === 'true') {
            if ($info->image) {
                Storage::delete('public/mapinfo/' . $info->image); // Path harus sama dengan tempat penyimpanan
            }
            $validated['image'] = null;
        }
        elseif ($request->hasFile('image')) {
            if ($info->image && Storage::exists('public/mapinfo/' . $info->image)) {
                Storage::delete('public/mapinfo/' . $info->image);
            }
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/mapinfo', $filename); // Ubah 'public/mapinformation' ke 'public/mapinfo'
            $validated['image'] = $filename; // Simpan nama file baru
        }

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        $info = MapInformation::findOrFail($id);
        if ($info->image && Storage::exists('public/mapinfo/' . $info->image)) { // Path harus sama
            Storage::delete('public/mapinfo/' . $info->image);
        }
        $info->delete();

        return response()->json(['message' => 'Map data deleted successfully']); // Pesan lebih spesifik
    }
}