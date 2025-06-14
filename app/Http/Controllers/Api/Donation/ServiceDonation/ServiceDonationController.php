<?php

namespace App\Http\Controllers\Api\Donation\ServiceDonation;

use App\Http\Controllers\Controller;
use App\Models\Donation\ServiceDonation\ServiceDonation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; 

class ServiceDonationController extends Controller
{
    public function index(): JsonResponse
    {
        $serviceDonations = ServiceDonation::all();
        return response()->json($serviceDonations);
    }

    public function show($id): JsonResponse
    {
        
        $serviceDonations = ServiceDonation::findOrFail($id);
        return response()->json($serviceDonations);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'donation_informations_id' => 'required|exists:donation_informations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'pricing' => 'required|string',
        ]);

        $serviceDonations = ServiceDonation::create($validated);
        return response()->json($serviceDonations, 201); // Mengembalikan status 201 Created
    }


    public function update(Request $request, $id): JsonResponse
    {
        $serviceDonations = ServiceDonation::findOrFail($id); // Gunakan findOrFail()

        $validated = $request->validate([
            'donation_informations_id' => 'required|exists:donation_informations,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'pricing' => 'required|string',
        ]);

        $serviceDonations->update($validated);
        return response()->json($serviceDonations);
    }


    public function destroy($id): JsonResponse
    {
        $serviceDonations = ServiceDonation::findOrFail($id); // Gunakan findOrFail()
        $serviceDonations->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}