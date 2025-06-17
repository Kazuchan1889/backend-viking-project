<?php

namespace App\Models\GameInfo\QuestInfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class DailyQuestAfterWar extends Model
{
    use HasFactory; 

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'daily_quest_after_war'; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category',
        'image',
        'daily_quest',
        'map',
        'quest',
        'reward',
    ];
}
