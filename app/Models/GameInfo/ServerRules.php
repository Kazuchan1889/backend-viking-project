<?php

namespace App\Models\GameInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo;

class ServerRules extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_information_id',
        'title',
        'description',
    ];

    public function featuresInformation()
    {
        return $this->belongsTo(GameInformation::class);
    }
}
