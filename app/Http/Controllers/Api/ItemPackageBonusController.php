<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donation\ItemPackageBonus;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; // Import untuk validasi
use Illuminate\Database\Eloquent\ModelNotFoundException; // Import untuk penanganan not found

class ItemPackageBonusController extends Controller
{

    public function index()
    {
        try {
            $itemPackageBonuses = ItemPackageBonus::with(['packageBonus', 'item'])->get();
            return response()->json($itemPackageBonuses);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve Item Package Bonuses.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'package_bonus_id' => 'required|exists:package_bonuses,id',
                'items_id' => 'required|exists:items,id',
            ]);

            // Cek untuk duplikasi sebelum membuat
            $existing = ItemPackageBonus::where('package_bonus_id', $validated['package_bonus_id'])
                                        ->where('items_id', $validated['items_id'])
                                        ->first();
            if ($existing) {
                return response()->json([
                    'message' => 'Item Package Bonus relationship already exists.',
                    'data' => $existing->load(['packageBonus', 'item'])
                ], 409); // 409 Conflict
            }

            $itemPackageBonus = ItemPackageBonus::create($validated);

            return response()->json([
                'message' => 'Item Package Bonus successfully added',
                'data' => $itemPackageBonus->load(['packageBonus', 'item']) // Load relations for response
            ], 201); // 201 Created

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while adding the Item Package Bonus.',
                'error' => $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            // Eager load 'packageBonus' dan 'item' (singular)
            $itemPackageBonus = ItemPackageBonus::with(['packageBonus', 'item'])->findOrFail($id);
            return response()->json($itemPackageBonus);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Item Package Bonus not found.'], 404); // 404 Not Found
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve Item Package Bonus.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $itemPackageBonus = ItemPackageBonus::findOrFail($id);

            $validated = $request->validate([
                'package_bonus_id' => 'required|exists:package_bonuses,id',
                'items_id' => 'required|exists:items,id',
            ]);

            // Opsional: Cek untuk duplikasi jika pasangan baru akan sama dengan yang sudah ada (selain id sendiri)
            $existing = ItemPackageBonus::where('package_bonus_id', $validated['package_bonus_id'])
                                        ->where('items_id', $validated['items_id'])
                                        ->where('id', '!=', $id) // Exclude current record
                                        ->first();
            if ($existing) {
                return response()->json([
                    'message' => 'The updated Item Package Bonus relationship already exists for another record.',
                    'data' => $existing->load(['packageBonus', 'item'])
                ], 409); // 409 Conflict
            }

            $itemPackageBonus->update($validated);

            return response()->json([
                'message' => 'Item Package Bonus successfully updated',
                'data' => $itemPackageBonus->load(['packageBonus', 'item'])
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Item Package Bonus not found.'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the Item Package Bonus.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $itemPackageBonus = ItemPackageBonus::findOrFail($id);
            $itemPackageBonus->delete();

            return response()->json(['message' => 'Item Package Bonus successfully deleted']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Item Package Bonus not found.'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the Item Package Bonus.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}