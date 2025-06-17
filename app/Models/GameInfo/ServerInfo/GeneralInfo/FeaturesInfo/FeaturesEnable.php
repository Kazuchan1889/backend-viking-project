<?php

namespace App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturesEnable extends Model
{
    use HasFactory;


    protected $fillable = [
        'feature',
        'description',
    ];
}