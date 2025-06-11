<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\QuestInfo\DailyQuestSunday;
use Illuminate\Http\Request;

class DailyQuestSundayController extends Controller
{
    public function index()
    {
        $info = DailyQuestSunday::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = DailyQuestSunday::find($id);
        if (!$info) {
            return response()->json(['message' => 'description is not found'], 404);
        }
        return response()->json($info);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|string',
            'tutorial' => 'required|string',
            'quest' => 'required|string',
            'reward' => 'required|string',
        ]);

        $info = DailyQuestSunday::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = DailyQuestSunday::findOrFail($id);

        $validated = $request->validate([
            'quest_information_id' => 'required|exists:quest_information,id',
            'image' => 'required|string',
            'tutorial' => 'required|string',
            'quest' => 'required|string',
            'reward' => 'required|string',
        ]);

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        $info = DailyQuestSunday::findOrFail($id);
        $info->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
