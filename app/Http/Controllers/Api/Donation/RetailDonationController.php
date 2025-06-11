<?php

namespace App\Http\Controllers\Api\Donation;

use App\Http\Controllers\Controller;
use App\Models\Donation\RetailDonation;
use Illuminate\Http\Request;

class RetailDonationController extends Controller
{
    /**
     * Tampilkan semua data RetailDonation.
     */
    public function index()
    {
        $data = RetailDonation::all();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Tampilkan satu data berdasarkan ID.
     */
    public function show($id)
    {
        $data = RetailDonation::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Simpan data baru ke tabel RetailDonation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'donation_id' => 'required|exists:donations,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'pricing'     => 'required|integer',
            'active_at'   => 'required|date_format:Y-m-d H:i:s',
        ]);

        $newData = RetailDonation::create($validated);

        return response()->json([
            'success' => true,
            'data' => $newData
        ], 201);
    }

    /**
     * Update data berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $data = RetailDonation::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 404);
        }

        $validated = $request->validate([
            'donation_id' => 'required|exists:donations,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'pricing'     => 'required|integer',
            'active_at'   => 'required|date_format:Y-m-d H:i:s',
        ]);

        $data->update($validated);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Hapus data berdasarkan ID.
     */
    public function destroy($id)
    {
        $data = RetailDonation::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}
