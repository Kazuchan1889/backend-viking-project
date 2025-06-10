<?php

namespace App\Models\GameInfo\ServerInfo\NPCList;

use Illuminate\Database\Eloquent\Model;

class NPCList extends Model
{
    public function raceHqNpcs()
    {
        return $this->hasMany(RaceHqNpc::class, 'npc_list_id'); // pastikan foreign key sesuai
    }
}
