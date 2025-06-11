<?php

namespace App\Http\Controllers\Api\Donation;

use App\Http\Controllers\Controller;
use App\Models\Donation\ServiceDonation;
use Illuminate\Http\Request;

class ServiceDonationController extends Controller
{
    // Ambil semua data
    public function index()
    {
        return response()->json(ServiceDonation::all());
    }

    // Ambil satu data berdasarkan ID
    public function show($id)
    {
        $info = ServiceDonation::find($id);

        if (!$info) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json($info);
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'donation_id' => 'required|exists:donations,id',
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'pricing' => 'required|integer',
            'timestamps' => 'required|date_format:Y-m-d H:i:s'
        ]);

        $info = ServiceDonation::create($validated);
        return response()->json($info, 201);
    }

    // Perbarui data
    public function update(Request $request, $id)
    {
        $info = ServiceDonation::findOrFail($id);

        $validated = $request->validate([
            'donation_id' => 'required|exists:donations,id',
            'title'       => 'required|string',
            'description' => 'nullable|string',
            'pricing' => 'required|integer',
            'timestamps' => 'required|date_format:Y-m-d H:i:s'
        ]);

        $info->update($validated);
        return response()->json($info);
    }

    // Hapus data
    public function destroy($id)
    {
        $info = ServiceDonation::findOrFail($id);
        $info->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
