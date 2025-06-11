<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\QuestInfo\DailyQuestSaturday;
use Illuminate\Http\Request;

class DailyQuestSaturdayController extends Controller
{
    public function index()
    {
        $info = DailyQuestSaturday::all();
        return response()->json($info);
    }

    public function show($id)
    {
        $info = DailyQuestSaturday::find($id);
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

        $info = DailyQuestSaturday::create($validated);
        return response()->json($info, 201);
    }

    public function update(Request $request, $id)
    {
        $info = DailyQuestSaturday::findOrFail($id);

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
        $info = DailyQuestSaturday::findOrFail($id);
        $info->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
