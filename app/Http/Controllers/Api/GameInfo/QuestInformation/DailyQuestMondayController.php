<?php

namespace App\Http\Controllers\Api\GameInfo\QuestInformation;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\QuestInfo\DailyQuestMonday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DailyQuestMondayController extends Controller
{
    public function index()
    {
        $info = DailyQuestMonday::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = DailyQuestMonday::find($id);
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

        $info = DailyQuestMonday::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = DailyQuestMonday::findOrFail($id);

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
            if ($info->image && Storage::exists('public/dailyquestmonday/' . $info->image)) {
                Storage::delete('public/dailyquestmonday/' . $info->image);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/dailyquestmonday', $filename);
            $validated['image'] = $filename;
        }

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        $info = DailyQuestMonday::findOrFail($id);

        // Hapus file image jika ada
        if ($info->image && Storage::exists('public/dailyquestmonday/' . $info->image)) {
            Storage::delete('public/dailyquestmonday/' . $info->image);
        }

        $info->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}

