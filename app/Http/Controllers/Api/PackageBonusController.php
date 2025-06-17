<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donation\PackageBonus;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; // Import untuk penanganan error validasi

class PackageBonusController extends Controller
{
    /**
     * Menampilkan daftar semua bonus paket.
     */
    public function index()
    {
        try {
            // Memuat relasi: paket utama, paket bonus, dan item terkait
            $packageBonuses = PackageBonus::with(['mainPackage', 'bonusPackage', 'items'])->get();
            return response()->json($packageBonuses);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve package bonuses.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menyimpan bonus paket baru.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'package_id' => 'required|exists:packages,id',
                'bonus_package_id' => 'required|exists:packages,id',
                'item_ids' => 'nullable|array', // item_ids bersifat opsional dan harus berupa array
                'item_ids.*' => 'exists:items,id', // Setiap ID dalam array harus ada di tabel 'items'
            ]);

            $bonus = PackageBonus::create([
                'package_id' => $validatedData['package_id'],
                'bonus_package_id' => $validatedData['bonus_package_id'],
            ]);

            // Jika item_ids disediakan, sinkronkan dengan bonus
            if (isset($validatedData['item_ids'])) {
                $bonus->items()->sync($validatedData['item_ids']);
            }

            return response()->json(['message' => 'Bonus created successfully', 'data' => $bonus], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the bonus.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan detail bonus paket berdasarkan ID.
     */
    public function show($id)
    {
        try {
            $bonus = PackageBonus::with(['mainPackage', 'bonusPackage', 'items'])->findOrFail($id);
            return response()->json($bonus);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Package bonus not found.'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve package bonus.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Memperbarui bonus paket yang ada.
     */
    public function update(Request $request, $id)
    {
        try {
            $bonus = PackageBonus::findOrFail($id);

            $validatedData = $request->validate([
                'package_id' => 'required|exists:packages,id',
                'bonus_package_id' => 'required|exists:packages,id',
                'item_ids' => 'nullable|array',
                'item_ids.*' => 'exists:items,id',
            ]);

            $bonus->update([
                'package_id' => $validatedData['package_id'],
                'bonus_package_id' => $validatedData['bonus_package_id'],
            ]);

            // Sinkronkan item-item: jika item_ids disediakan, sinkronkan;
            // jika tidak, lepaskan semua item yang ada dari bonus ini.
            if (isset($validatedData['item_ids'])) {
                $bonus->items()->sync($validatedData['item_ids']);
            } else {
                $bonus->items()->detach(); // Lepaskan semua item jika array kosong atau tidak ada
            }

            return response()->json(['message' => 'Bonus updated successfully', 'data' => $bonus]);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Package bonus not found.'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while updating the bonus.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menghapus bonus paket.
     */
    public function destroy($id)
    {
        try {
            $bonus = PackageBonus::findOrFail($id);
            $bonus->delete();

            return response()->json(['message' => 'Bonus deleted successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Package bonus not found.'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while deleting the bonus.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}