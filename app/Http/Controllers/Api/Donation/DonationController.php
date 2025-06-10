<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation\Donation;


class DonationController extends Controller
{
    public function index()
    {
        // Ambil semua data ServerInformation beserta relasi-relasinya
        $donation = Donation::with([
            'RetailDonation',
            'ServiceDonation',
            'SeassonDonation',
            'PackageDonation',
            'HowToDonation',    
        ])->get();

        return response()->json($donation);
    }

    public function show($id)
    {
        $donation = Donation::with([
            'RetailDonation',
            'ServiceDonation',
            'SeassonDonation',
            'PackageDonation',
            'HowToDonation', 
        ])->findOrFail($id);

        return response()->json($donation);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            // Tambahkan field lain jika dibutuhkan
        ]);

        $donation = Donation::create($validated);

        return response()->json($donation, 201);
    }

    public function update(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            // Tambahkan field lain jika dibutuhkan
        ]);

        $donation->update($validated);

        return response()->json($donation);
    }

    public function destroy($id)
    {
        Donation::findOrFail($id)->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
