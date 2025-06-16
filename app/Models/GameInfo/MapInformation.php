<?php

namespace App\Models\GameInfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\GameInfo\GameInformation;
use App\Models\GameInfo\ServerInfo\NPCList\NpcList;
use App\Models\GameInfo\ServerInfo\DropList\DropList;

class MapInformation extends Model
{
    use HasFactory;

    protected $table = 'map_informations';

    protected $fillable = [
        'game_information_id',
        'map_name',
        'image',

    ];

    public $timestamps = true;

    /**
     * Relasi ke GameInformation (many-to-one)
     */
    public function gameInformation()
    {
        return $this->belongsTo(GameInformation::class, 'game_information_id', 'id');
    }

    /**
     * Relasi ke NPC List (one-to-many)
     */
    public function npcLists()
    {
        return $this->hasMany(NpcList::class, 'map_information_id', 'id');
    }

    /**
     * Relasi ke Drop List (one-to-many)
     */
    public function dropLists()
    {
        return $this->hasMany(DropList::class, 'map_information_id', 'id');
    }
}
