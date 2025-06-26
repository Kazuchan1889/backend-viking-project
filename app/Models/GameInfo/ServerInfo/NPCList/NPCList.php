<?php

namespace App\Models\GameInfo\ServerInfo\NPCList;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\MapInformation;

class NPCList extends Model
{
    use HasFactory;

    protected $table = 'npclist';

    protected $fillable = [
        'npc',
        'buy_with',
        'map_information_id',
    ];

    public function mapInformation()
    {
        return $this->belongsTo(MapInformation::class, 'map_information_id');
    }
}
