<?php

namespace App\Models\GameInfo\QuestInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\QuestInfo\QuestInformation;

class DailyQuestWednesday extends Model
{
    use HasFactory;

    protected $fillable = [
        'quest_information_id',
        'image',
        'tutorial',
        'quest',
        'rewards',
    ];
    public function questInformation()
    {
        return $this->belongsTo(QuestInformation::class);
    }
}