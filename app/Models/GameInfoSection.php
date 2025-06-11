<?php

namespace App\Models\GameInfo;

use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\ServerInfo\ServerInformationGameInfo;
use App\Models\GameInfo\QuestInfo\QuestInformation;
use App\Models\GameInfo\ServerRules;
use App\Models\GameInfo\MapInformation;


class GameInfoSection extends Model
{
    protected $fillable = [
        'title', // atau field lain yang kamu miliki
    ];

    public function serverInformation()
    {
        return $this->hasMany(ServerInformationGameInfo::class);
    }

    public function questInformation()
    {
        return $this->hasMany(QuestInformation::class);
    }

    public function serverRules()
    {
        return $this->hasMany(ServerRules::class);
    }

    public function mapInformation()
    {
        return $this->hasMany(MapInformation::class);
    }
}
