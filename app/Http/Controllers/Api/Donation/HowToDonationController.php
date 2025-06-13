<?php

namespace App\Http\Controllers\Api\Donation;

use App\Http\Controllers\Controller;
use App\Models\Donation\HowToDonation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; // Penting: Import ini untuk type hinting

class HowToDonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // Ubah $droplists menjadi $retailDonations untuk konsistensi dengan nama model
        $retailDonations = HowToDonation::all();
        return response()->json($retailDonations);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        // Gunakan findOrFail() untuk penanganan 404 yang lebih ringkas.
        // Laravel secara otomatis akan mengembalikan 404 jika ID tidak ditemukan.
        $retailDonation = HowToDonation::findOrFail($id);
        return response()->json($retailDonation);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            // Pastikan 'game_information_id' benar-benar nama kolom di tabel game_informations
            'donation_informations_id' => 'required|exists:donation_informations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Ubah $droplist menjadi $retailDonation untuk konsistensi
        $retailDonation = HowToDonation::create($validated);
        return response()->json($retailDonation, 201); // Mengembalikan status 201 Created
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $retailDonation = HowToDonation::findOrFail($id); // Gunakan findOrFail()

        $validated = $request->validate([
            'donation_informations_id' => 'required|exists:donation_informations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $retailDonation->update($validated);
        return response()->json($retailDonation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $retailDonation = HowToDonation::findOrFail($id); // Gunakan findOrFail()
        $retailDonation->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}