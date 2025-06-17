<?php

namespace App\Http\Controllers\Api\GameInfo\QuestInformation;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\QuestInfo\DailyQuestAfterWar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DailyQuestAfterWarController extends Controller
{
    public function index()
    {
        $info = DailyQuestAfterWar::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = DailyQuestAfterWar::find($id);
        if (!$info) {
            return response()->json(['message' => 'description is not found'], 404);
        }
        return response()->json($info);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'image' => 'required|file|image|mimes:jpg,jpeg,png|max:2048',
            'daily_quest' => 'required|string',
            'map' => 'required|string',
            'quest' => 'required|string',
            'reward' => 'required|string',
        ]);

        $info = DailyQuestAfterWar::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = DailyQuestAfterWar::findOrFail($id);

        $validated = $request->validate([
            'category' => 'required|string',
            'image' => 'required|file|image|mimes:jpg,jpeg,png|max:2048',
            'daily_quest' => 'required|string',
            'map' => 'required|string',
            'quest' => 'required|string',
            'reward' => 'required|string',
        ]);

        // Simpan gambar baru jika diupload
        if ($request->hasFile('image')) {
            // Hapus file lama jika perlu
            if ($info->image && Storage::exists('public/dailyquestafterwar/' . $info->image)) {
                Storage::delete('public/dailyquestafterwar/' . $info->image);
            }

            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/dailyquestafterwar', $filename);
            $validated['image'] = $filename;
        }

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        $info = DailyQuestAfterWar::findOrFail($id);

        // Hapus file image jika ada
        if ($info->image && Storage::exists('public/dailyquestafterwar/' . $info->image)) {
            Storage::delete('public/dailyquestafterwar/' . $info->image);
        }

        $info->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}

