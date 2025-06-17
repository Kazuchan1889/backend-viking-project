<?php

namespace App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturesDisable extends Model
{
    use HasFactory;

    protected $fillable = [
        'feature',
        'description',
    ];
}
