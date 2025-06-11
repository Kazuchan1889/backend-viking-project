<?php

namespace App\Models\GameInfo\ServerInfo\FeatureInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\ServerInfo\FeatureInfo\FeatureInformation;


class PendantInformation extends Model
{
    use HasFactory;

    protected $fillable = [
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