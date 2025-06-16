<?php

namespace App\Models\GameInfo\ServerInfo\GeneralInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\GameInformation;

class ServersInformation extends Model
{
    use HasFactory;

    protected $table = 'serversinformations'; // opsional jika tabel tidak mengikuti konvensi Laravel

    protected $fillable = [
        'game_information_id',
        'title',
        'description',
    ];

    /**
     * Relationship: ServersInformation belongs to GameInformation
     */
    public function gameInformation()
    {
        return $this->belongsTo(GameInformation::class, 'game_information_id');
    }
}
