<?php

namespace App\Models\GameInfo\ServerInfo\NPCList;

use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\ServerInfo\NPCList\RaceHqNpc;
use App\Models\GameInfo\ServerInfo\NPCList\ElanPlateauNpc;
use App\Models\GameInfo\ServerInfo\NPCList\SetteDessertNpc;
use App\Models\GameInfo\ServerInfo\NPCList\VolcanicCauldronNpc;




class NPCList extends Model
{
    protected $fillable = ['title'];

    public function racehqnpc()
    {
        return $this->hasMany(related: RaceHqNpc::class);
    }

    public function elanplateaunpc()
    {
        return $this->hasMany(ElanPlateauNpc::class);
    }

    public function settedessertnpc()
    {
        return $this->hasMany(SetteDessertNpc::class);
    }

    public function volcaniccauldronnpc()
    {
        return $this->hasMany(VolcanicCauldronNpc::class);
    }
}

