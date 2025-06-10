<?php

namespace App\Models\GameInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_info_id',
        'location_name',
        'image',
    ];
    public function gameInfoSection()
{
    return $this->belongsTo(\App\Models\GameInfo\GameInfoSection::class, 'game_info_id');
}

}
