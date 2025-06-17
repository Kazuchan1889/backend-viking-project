<?php

namespace App\Http\Controllers\Api\Donation;

use App\Http\Controllers\Controller;
use App\Models\Donation\HowToDonation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; 

class HowToDonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $retailDonations = HowToDonation::all();
        return response()->json($retailDonations);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $howtoDonation = HowToDonation::findOrFail($id);
        return response()->json($howtoDonation);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'donation_guide' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $howtoDonation = HowToDonation::create($validated);
        return response()->json($howtoDonation, 201); // Mengembalikan status 201 Created
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $howtoDonation = HowToDonation::findOrFail($id); // Gunakan findOrFail()

        $validated = $request->validate([
            'donation_guide' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $howtoDonation->update($validated);
        return response()->json($howtoDonation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $howtoDonation = HowToDonation::findOrFail($id); // Gunakan findOrFail()
        $howtoDonation->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}