<?php

namespace App\Models\GameInfo\QuestInfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use App\Models\GameInfo\GameInformation; 

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
        'game_information_id', 
        'category',
        'image',
        'daily_quest',
        'map',
        'quest',
        'reward',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gameInformation() // <-- Relasi ke GameInformation
    {
        return $this->belongsTo(GameInformation::class, 'game_information_id', 'id');
    }
}
