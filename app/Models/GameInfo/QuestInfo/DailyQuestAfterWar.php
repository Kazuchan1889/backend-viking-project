<?php

namespace App\Models\GameInfo\QuestInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\QuestInfo\QuestInformation;

class DailyQuestAfterWar extends Model
{
    use HasFactory;

    protected $fillable = [
        'quest_information_id',
        'image',
        'daily_quest',
        'map',
        'quest',
        'rewards',
    ];

    public function questInformation()
    {
        return $this->belongsTo(QuestInformation::class);
    }
}
