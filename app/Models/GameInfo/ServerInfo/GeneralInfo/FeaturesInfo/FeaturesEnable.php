<?php

namespace App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo\FeaturesInformation;


class FeaturesEnable extends Model
{
    use HasFactory;

    protected $fillable = [
        'general_information_id',
        'title',
        'description',
    ];
    public function questInformation()
    {
        return $this->belongsTo(FeaturesInformation::class);
    }
}