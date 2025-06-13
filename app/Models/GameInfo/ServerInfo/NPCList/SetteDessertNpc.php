<?php

namespace App\Models\GameInfo\ServerInfo\NPCList;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use App\Models\GameInfo\GameInformation; 

class SetteDessertNpc extends Model
{
    use HasFactory; 

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sette_dessert_npcs'; 
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
