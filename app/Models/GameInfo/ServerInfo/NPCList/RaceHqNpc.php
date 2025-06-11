<?php

namespace App\Models\GameInfo\ServerInfo\NPCList;

use Illuminate\Database\Eloquent\Model;

class RaceHqNpc extends Model
{
    protected $fillable = [
    'game_information_id',
    'npc',
    'buy_with',
];

    public function npcList()
    {
        return $this->belongsTo(NPCList::class, 'npc_list_id');
    }
}

 