<?php

namespace App\Models\GameInfo\QuestInfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Import model-model daily quest
use App\Models\GameInfo\QuestInfo\DailyQuestAfterWar;
use App\Models\GameInfo\QuestInfo\DailyQuest;

class QuestInformation extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    // Relasi ke masing-masing harian
    public function dailyquestafterwar()
    {
        return $this->hasMany(DailyQuestAfterWar::class);
    }

    public function dailyquest()
    {
        return $this->hasMany(DailyQuest::class);
    }
}
