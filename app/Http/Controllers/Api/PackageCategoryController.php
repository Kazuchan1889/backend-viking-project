<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donation\PackageCategory;
use Illuminate\Http\Request;

class PackageCategoryController extends Controller
{
    public function index()
    {
        return PackageCategory::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category = PackageCategory::create($request->all());

        return response()->json(['message' => 'Kategori berhasil dibuat', 'data' => $category]);
    }

    public function show($id)
    {
        return PackageCategory::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $category = PackageCategory::findOrFail($id);
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category->update($request->all());

        return response()->json(['message' => 'Kategori berhasil diperbarui', 'data' => $category]);
    }

    public function destroy($id)
    {
        $category = PackageCategory::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Kategori berhasil dihapus']);
    }
}
