<?php

namespace App\Models\GameInfo\ServerInfo\NPCList;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\GameInfo\GameInformation; 
class RaceHqNpc extends Model
{
    use HasFactory; 

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'race_hq_npcs'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'game_information_id',
        'npc',
        'buy_with',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true; // <-- Asumsi Anda ingin menggunakan timestamps (created_at, updated_at)

    /**
     * Get the game information that owns the RaceHqNpc.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gameInformation() // <-- Relasi ke GameInformation
    {
        return $this->belongsTo(GameInformation::class, 'game_information_id', 'id');
    }
}
