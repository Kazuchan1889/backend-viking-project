<?php

namespace App\Models\GameInfo\ServerInfo\NPCList;

use Illuminate\Database\Eloquent\Model;

class RaceHqNpc extends Model
{
    protected $fillable = ['npc_list_id', 'title', 'description'];

    public function npcList()
    {
        return $this->belongsTo(NPCList::class, 'npc_list_id');
    }
}

