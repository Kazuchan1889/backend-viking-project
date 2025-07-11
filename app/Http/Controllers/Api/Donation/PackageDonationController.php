<?php

namespace App\Http\Controllers\Api\Donation;

use App\Http\Controllers\Controller;
use App\Models\Donation\PackageDonation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; 

class PackageDonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $retailDonations = PackageDonation::all();
        return response()->json($retailDonations);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
    
        $retailDonation = PackageDonation::findOrFail($id);
        return response()->json($retailDonation);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'donation_informations_id' => 'required|exists:donation_informations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'pricing' => 'required|string',
        ]);

        $retailDonation = PackageDonation::create($validated);
        return response()->json($retailDonation, 201); // Mengembalikan status 201 Created
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $retailDonation = PackageDonation::findOrFail($id); // Gunakan findOrFail()

        $validated = $request->validate([
            'donation_informations_id' => 'required|exists:donation_informations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'pricing' => 'required|string',
        ]);

        $retailDonation->update($validated);
        return response()->json($retailDonation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $retailDonation = PackageDonation::findOrFail($id); // Gunakan findOrFail()
        $retailDonation->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}