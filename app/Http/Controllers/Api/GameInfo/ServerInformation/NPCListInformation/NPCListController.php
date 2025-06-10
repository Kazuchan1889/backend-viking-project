<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameInfo\ServerInfo\NPCList\NPCList;
use App\Models\GameInfo\ServerInfo\NPCList\RaceHqNpc;

class NpcListController extends Controller
{
    public function index()
    {
        // Pastikan relasi bernama 'raceHqNpcs' didefinisikan di model NPCList
        $data = NPCList::with('raceHqNpcs')->get();

        return response()->json($data);
    }

    public function raceHqOnly()
    {
        $data = RaceHqNpc::all();
        return response()->json($data);
    }
}
