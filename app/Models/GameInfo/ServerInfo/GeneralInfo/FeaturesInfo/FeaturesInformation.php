<?php

namespace App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo;

use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo\FeaturesEnable;
use App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo\FeaturesDisable;

class FeaturesInformation extends Model
{
    protected $fillable = ['title'];

    public function featuresEnable()
    {
        return $this->hasMany(FeaturesEnable::class);
    }

    public function featuresDisable()
    {
        return $this->hasMany(FeaturesDisable::class);
    }
}
