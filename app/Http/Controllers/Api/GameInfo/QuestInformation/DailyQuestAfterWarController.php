<?php

namespace App\Http\Controllers\Api;

use App\Models\GameInfo\QuestInfo\DailyQuestAfterWar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            'quest_information_id' => 'required|exists:quest_information,id',
            'image' => 'required|string',
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
            'quest_information_id' => 'required|exists:quest_information,id',
            'image' => 'required|string',
            'daily_quest' => 'required|string',
            'map' => 'required|string',
            'quest' => 'required|string',
            'reward' => 'required|string',
        ]);

        $info->update($validated);
        return response()->json($info);
    }

    public function destroy($id)
    {
        $info = DailyQuestAfterWar::findOrFail($id);
        $info->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
