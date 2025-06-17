<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donation\Packages;
use App\Models\Donation\PackageBonus; 
use App\Models\GameInfo\Items;        
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; 

class PackagesController extends Controller
{
    // GET /api/packages
    public function index()
    {
        $packages = Packages::with(['category', 'bonuses.bonusPackage', 'item'])->get();
        return response()->json($packages);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'package_name' => 'required|string|max:255',
                'category_id' => 'required|exists:package_categories,id',
                'items_id' => 'required|exists:items,id', 
                'price' => 'nullable|string',
                'is_bonus_package' => 'required|boolean',
                
            ]);

            $package = Packages::create([
                'package_name' => $validated['package_name'],
                'category_id' => $validated['category_id'],
                'items_id' => $validated['items_id'], 
                'price' => $validated['price'],
                'is_bonus_package' => $validated['is_bonus_package'],
            ]);

        
            return response()->json(['message' => 'Package created successfully', 'data' => $package], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the package.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $package = Packages::with(['category', 'bonuses.bonusPackage', 'item'])->findOrFail($id);
        return response()->json($package);
    }

    public function update(Request $request, $id)
    {
        try {
            $package = Packages::findOrFail($id);

            $validated = $request->validate([
                'package_name' => 'required|string|max:255',
                'category_id' => 'required|exists:package_categories,id',
                'items_id' => 'required|exists:items,id', 
                'price' => 'nullable|string',
                'is_bonus_package' => 'required|boolean',
               
            ]);

            $package->update([
                'package_name' => $validated['package_name'],
                'category_id' => $validated['category_id'],
                'items_id' => $validated['items_id'], 
                'price' => $validated['price'],
                'is_bonus_package' => $validated['is_bonus_package'],
            ]);

        

            return response()->json(['message' => 'Package updated successfully', 'data' => $package]);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the package.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $package = Packages::findOrFail($id);
            $package->delete();

            return response()->json(['message' => 'Package deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the package.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}