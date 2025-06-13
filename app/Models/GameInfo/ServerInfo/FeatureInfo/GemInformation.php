<?php

namespace App\Models\GameInfo\ServerInfo\FeatureInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\ServerInfo\FeatureInfo\FeatureInformation;


class GemInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_information_id',
        'image',
        'name_item',
        'type',
        'trade',
    ];
    public function questInformation()
    {
        return $this->belongsTo(FeatureInformation::class);
    }
}