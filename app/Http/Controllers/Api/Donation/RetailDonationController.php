<?php

namespace App\Http\Controllers\Api\Donation;

use App\Http\Controllers\Controller;
use App\Models\Donation\RetailDonation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; // Penting: Import ini untuk type hinting

class RetailDonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $retailDonations = RetailDonation::all();
        return response()->json($retailDonations);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        
        $retailDonation = RetailDonation::findOrFail($id);
        return response()->json($retailDonation);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'donation_title' => 'required|string|max:255',
            'pricing' => 'required|string',
        ]);

        $retailDonation = RetailDonation::create($validated);
        return response()->json($retailDonation, 201); 
    }

    public function update(Request $request, $id): JsonResponse
    {
        $retailDonation = RetailDonation::findOrFail($id); 

        $validated = $request->validate([
            'donation_title' => 'required|string|max:255',
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
        $retailDonation = RetailDonation::findOrFail($id);
        $retailDonation->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}