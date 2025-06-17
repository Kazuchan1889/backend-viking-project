<?php

namespace App\Models\GameInfo\ServerInfo\FeatureInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PendantInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name_item',
        'type',
        'trade',
    ];
}