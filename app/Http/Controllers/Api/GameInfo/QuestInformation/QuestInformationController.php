<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\QuestInfo\QuestInformation;
use Illuminate\Http\Request;

class QuestInformationController extends Controller
{
    public function index()
    {
        $questinfo = QuestInformation::with([
            'dailyQuestAfterWar',
            'dailyQuestSunday',
            'dailyQuestSaturday',
            'dailyQuestFriday',
            'dailyQuestThursday',
            'dailyQuestWednesday',
            'dailyQuestTuesday',
            'dailyQuestMonday',
        ])->get();

        return response()->json($questinfo);
    }

    public function show($id)
    {
        $questinfo = QuestInformation::with([
            'dailyQuestAfterWar',
            'dailyQuestSunday',
            'dailyQuestSaturday',
            'dailyQuestFriday',
            'dailyQuestThursday',
            'dailyQuestWednesday',
            'dailyQuestTuesday',
            'dailyQuestMonday',
        ])->findOrFail($id);

        return response()->json($questinfo);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $questinfo = QuestInformation::create($validated);

        return response()->json($questinfo, 201);
    }

    public function update(Request $request, $id)
    {
        $questinfo = QuestInformation::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
        ]);

        $questinfo->update($validated);

        return response()->json($questinfo);
    }

    public function destroy($id)
    {
        QuestInformation::findOrFail($id)->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
