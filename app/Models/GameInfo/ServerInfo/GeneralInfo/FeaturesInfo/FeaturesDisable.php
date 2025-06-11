<?php

namespace App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo\FeaturesInformation;

class FeaturesDisable extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function featuresInformation()
    {
        return $this->belongsTo(FeaturesInformation::class);
    }
}
