<?php

namespace App\Http\Controllers\Api\GameInfo;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\MapInformation; // Pastikan namespace ini benar dan mengarah ke model MapInformation Anda
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

    // Metode baru untuk mengambil data berdasarkan map_number
    public function getMapDataByNumber($mapNumber)
    {
        $mapData = MapInformation::where('map_number', $mapNumber)->get();
        if ($mapData->isEmpty()) {
            // Mengembalikan 404 jika tidak ada data yang ditemukan untuk map_number
            return response()->json(['message' => 'No map data found for this map number.'], 404);
        }
        return response()->json($mapData);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_information_id' => 'required|integer|exists:game_informations,id', // Tambahkan 'integer'
            'map_number' => 'required|string|max:255', // Tambahkan max length
            'location_name' => 'required|string|max:255',
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png,gif,svg', // Ubah ke 'nullable' dan tambahkan mime types umum, max size
        ]);

        if ($request->hasFile('image')) {
            // Path penyimpanan harus konsisten dengan yang diakses frontend: storage/mapinfo/
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/mapinfo', $filename); // Ubah 'public/gems' ke 'public/mapinfo'
            $validated['image'] = $filename; // Simpan hanya nama file ke database
        } else {
            $validated['image'] = null; // Pastikan image null jika tidak ada file diupload
        }

        $info = MapInformation::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = MapInformation::findOrFail($id);

        // Aturan validasi yang lebih fleksibel untuk update
        $validated = $request->validate([
            'game_information_id' => 'required|integer|exists:game_informations,id', // Tambahkan 'integer'
            'map_number' => 'required|string|max:255', // Tambahkan max length
            'location_name' => 'required|string|max:255',
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png,gif,svg', // Ubah ke 'nullable' karena tidak selalu ada file baru
        ]);

        // Logic untuk menghapus gambar lama jika ada permintaan 'image_removed' dari frontend
        if ($request->has('image_removed') && $request->input('image_removed') === 'true') {
            if ($info->image) {
                Storage::delete('public/mapinfo/' . $info->image); // Path harus sama dengan tempat penyimpanan
            }
            $validated['image'] = null; // Set gambar di DB menjadi NULL
        }
        // Logic untuk menyimpan gambar baru jika diupload
        elseif ($request->hasFile('image')) {
            // Hapus gambar lama sebelum menyimpan yang baru (jika ada dan tidak diminta hapus)
            if ($info->image && Storage::exists('public/mapinfo/' . $info->image)) {
                Storage::delete('public/mapinfo/' . $info->image);
            }
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/mapinfo', $filename); // Ubah 'public/mapinformation' ke 'public/mapinfo'
            $validated['image'] = $filename; // Simpan nama file baru
        }
        // Jika tidak ada gambar baru dan tidak ada permintaan hapus, biarkan nilai 'image' di $validated tidak berubah
        // agar gambar lama tetap dipertahankan.

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        $info = MapInformation::findOrFail($id);
        // Logic untuk menghapus file gambar saat record dihapus
        if ($info->image && Storage::exists('public/mapinfo/' . $info->image)) { // Path harus sama
            Storage::delete('public/mapinfo/' . $info->image);
        }
        $info->delete();

        return response()->json(['message' => 'Map data deleted successfully']); // Pesan lebih spesifik
    }
}