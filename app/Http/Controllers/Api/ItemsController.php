<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\Items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
        return Items::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'items_name' => 'required|string|max:255',
        ]);

        $item = Items::create($request->all());

        return response()->json(['message' => 'Item berhasil ditambahkan', 'data' => $item]);
    }

    public function show($id)
    {
        return Items::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = Items::findOrFail($id);
        $request->validate([
            'items_name' => 'required|string|max:255',
        ]);

        $item->update($request->all());

        return response()->json(['message' => 'Item berhasil diperbarui', 'data' => $item]);
    }

    public function destroy($id)
    {
        $item = Items::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item berhasil dihapus']);
    }
}
