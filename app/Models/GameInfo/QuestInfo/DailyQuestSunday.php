<?php

namespace App\Models\GameInfo\QuestInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\QuestInfo\QuestInformation;

class DailyQuestSunday extends Model
{
    use HasFactory;

    protected $fillable = [
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
