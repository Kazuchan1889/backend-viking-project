<?php

namespace App\Models\GameInfo\ServerInfo\GeneralInfo;

use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo\FeaturesInformation;

class GeneralInformation extends Model
{
    protected $fillable = ['title', 'description'];

    public function featuresInformation()
    {
        return $this->hasOne(FeaturesInformation::class, 'general_information_id');
    }
}
