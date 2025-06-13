<?php

namespace App\Http\Controllers\Api\GameInfo\QuestInformation;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\QuestInfo\DailyQuestFriday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DailyQuestFridayController extends Controller
{
    public function index()
    {
        $info = DailyQuestFriday::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = DailyQuestFriday::find($id);
        if (!$info) {
            return response()->json(['message' => 'description is not found'], 404);
        }
        return response()->json($info);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_information_id' => 'required|exists:game_informations,id',
            'image' => 'required|file|image|mimes:jpg,jpeg,png|max:2048',
            'tutorial' => 'required|string',
            'quest' => 'required|string',
            'reward' => 'required|string',
        ]);

        $info = DailyQuestFriday::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = DailyQuestFriday::findOrFail($id);

        $validated = $request->validate([
            'game_information_id' => 'required|exists:game_informations,id',
            'image' => 'required|file|image|mimes:jpg,jpeg,png|max:2048',
            'tutorial' => 'required|string',
            'quest' => 'required|string',
            'reward' => 'required|string',
        ]);

        // Simpan gambar baru jika diupload
        if ($request->hasFile('image')) {
            // Hapus file lama jika perlu
            if ($info->image && Storage::exists('public/dailyquestfriday/' . $info->image)) {
                Storage::delete('public/dailyquestfriday/' . $info->image);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/dailyquestfriday', $filename);
            $validated['image'] = $filename;
        }

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        $info = DailyQuestFriday::findOrFail($id);

        // Hapus file image jika ada
        if ($info->image && Storage::exists('public/dailyquestfriday/' . $info->image)) {
            Storage::delete('public/dailyquestfriday/' . $info->image);
        }

        $info->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}

