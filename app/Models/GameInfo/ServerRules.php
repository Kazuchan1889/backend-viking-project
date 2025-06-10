<?php

namespace App\Models\GameInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerRules extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_info_id',
        'title',
        'description',
    ];
    public function gameInfoSection()
{
    return $this->belongsTo(\App\Models\GameInfo\GameInfoSection::class, 'game_info_id');
}

}
