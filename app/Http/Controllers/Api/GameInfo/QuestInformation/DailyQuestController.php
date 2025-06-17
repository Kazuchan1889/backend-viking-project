<?php

namespace App\Http\Controllers\Api\GameInfo\QuestInformation;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\QuestInfo\DailyQuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DailyQuestController extends Controller
{
    public function index()
    {
        $info = DailyQuest::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = DailyQuest::find($id);
        if (!$info) {
            return response()->json(['message' => 'Quest not found'], 404);
        }
        return response()->json($info);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'day' => 'required|string',
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png|max:2048',
            'tutorial' => 'required|string',
            'quest' => 'required|string',
            'reward' => 'required|string',
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/dailyquest', $filename);
            $validated['image'] = $filename;
        }

        $info = DailyQuest::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = DailyQuest::findOrFail($id);

        $validated = $request->validate([
            'day' => 'required|string', 
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png|max:2048',
            'tutorial' => 'required|string',
            'quest' => 'required|string',
            'reward' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            if ($info->image && Storage::exists('public/dailyquest/' . $info->image)) {
                Storage::delete('public/dailyquest/' . $info->image);
            }
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/dailyquest', $filename);
            $validated['image'] = $filename;
        }

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        $info = DailyQuest::findOrFail($id);

        if ($info->image && Storage::exists('public/dailyquest/' . $info->image)) {
            Storage::delete('public/dailyquest/' . $info->image);
        }

        $info->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}