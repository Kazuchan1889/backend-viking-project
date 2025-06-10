<?php

namespace App\Models\GameInfo\ServerInfo\FeatureInfo;

use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\ServerInfo\FeatureInfo\PendantInformation;
use App\Models\GameInfo\ServerInfo\FeatureInfo\GemInformation;


class FeatureInformation extends Model
{
    protected $fillable = ['title'];

    public function pendantinformation()
    {
        return $this->hasMany(related: PendantInformation::class);
    }

    public function geminformation()
    {
        return $this->hasMany(GemInformation::class);
    }

}

