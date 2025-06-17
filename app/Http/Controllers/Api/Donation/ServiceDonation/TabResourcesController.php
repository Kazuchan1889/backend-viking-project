<?php

namespace App\Http\Controllers\Api\Donation\ServiceDonation;

use App\Http\Controllers\Controller;
use App\Models\Donation\ServiceDonation\TabResources;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; 

class TabResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $serviceDonations = TabResources::all();
        return response()->json($serviceDonations);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        
        $serviceDonations = TabResources::findOrFail($id);
        return response()->json($serviceDonations);
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

        $serviceDonations = TabResources::create($validated);
        return response()->json($serviceDonations, 201); // Mengembalikan status 201 Created
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $serviceDonations = TabResources::findOrFail($id); // Gunakan findOrFail()

        $validated = $request->validate([
            'donation_title' => 'required|string|max:255',
            'pricing' => 'required|string',
        ]);

        $serviceDonations->update($validated);
        return response()->json($serviceDonations);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $serviceDonations = TabResources::findOrFail($id); 
        $serviceDonations->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}