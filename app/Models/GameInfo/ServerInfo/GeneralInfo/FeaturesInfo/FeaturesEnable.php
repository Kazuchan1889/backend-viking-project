<?php

namespace App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\GameInformation; 

class FeaturesEnable extends Model
{
    use HasFactory;


    protected $fillable = [
        'game_information_id',
        'title',
        'description',
    ];

    public function gameInformation() 
    {
        return $this->belongsTo(GameInformation::class, 'game_information_id', 'id');
    }
}