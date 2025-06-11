<?php

namespace App\Models\GameInfo\ServerInfo\NPCList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolcanicCauldronNpc extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_information_id',
        'npc',
        'buy_with',
    ];
}
