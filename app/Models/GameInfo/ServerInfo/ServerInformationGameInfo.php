<?php

namespace App\Models\GameInfo\ServerInfo;

use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\ServerInfo\FeatureInfo\FeatureInformation;
use App\Models\GameInfo\ServerInfo\GeneralInfo\GeneralInformation;
use App\Models\GameInfo\ServerInfo\NPCList\NPCList;
use App\Models\GameInfo\ServerInfo\DropList\DropList;



class ServerInformationGameInfo extends Model
{
    protected $fillable = [
        'game_info_id',
        'title', // atau field lain yang kamu miliki
    ];

    public function FeatureInformation()
    {
        return $this->hasMany(FeatureInformation::class);
    }

    public function GeneralInformation()
    {
        return $this->hasMany(GeneralInformation::class);
    }

    public function NPCList()
    {
        return $this->hasMany(NPCList::class);
    }

    public function DropList()
    {
        return $this->hasMany(related: DropList::class);
    }
}
