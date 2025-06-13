<?php

namespace App\Models\GameInfo\QuestInfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Import model-model daily quest
use App\Models\GameInfo\QuestInfo\DailyQuestAfterWar;
use App\Models\GameInfo\QuestInfo\DailyQuestFriday;
use App\Models\GameInfo\QuestInfo\DailyQuestSaturday;
use App\Models\GameInfo\QuestInfo\DailyQuestSunday;
use App\Models\GameInfo\QuestInfo\DailyQuestThursday;
use App\Models\GameInfo\QuestInfo\DailyQuestTuesday;
use App\Models\GameInfo\QuestInfo\DailyQuestWednesday;

class QuestInformation extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    // Relasi ke masing-masing harian
    public function dailyquestafterwar()
    {
        return $this->hasMany(DailyQuestAfterWar::class);
    }

    public function dailyquestfriday()
    {
        return $this->hasMany(DailyQuestFriday::class);
    }

    public function dailyquestsaturday()
    {
        return $this->hasMany(DailyQuestSaturday::class);
    }

    public function dailyquestsunday()
    {
        return $this->hasMany(DailyQuestSunday::class);
    }

    public function dailyquestthursday()
    {
        return $this->hasMany(DailyQuestThursday::class);
    }

    public function dailyquesttuesday()
    {
        return $this->hasMany(DailyQuestTuesday::class);
    }

    public function dailyquestwednesday()
    {
        return $this->hasMany(DailyQuestWednesday::class);
    }
}
