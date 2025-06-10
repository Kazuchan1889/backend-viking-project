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
    public function dailyQuestAfterWar()
    {
        return $this->hasMany(DailyQuestAfterWar::class);
    }

    public function dailyQuestFriday()
    {
        return $this->hasMany(DailyQuestFriday::class);
    }

    public function dailyQuestSaturday()
    {
        return $this->hasMany(DailyQuestSaturday::class);
    }

    public function dailyQuestSunday()
    {
        return $this->hasMany(DailyQuestSunday::class);
    }

    public function dailyQuestThursday()
    {
        return $this->hasMany(DailyQuestThursday::class);
    }

    public function dailyQuestTuesday()
    {
        return $this->hasMany(DailyQuestTuesday::class);
    }

    public function dailyQuestWednesday()
    {
        return $this->hasMany(DailyQuestWednesday::class);
    }
}
