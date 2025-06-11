<?php

namespace App\Models\GameInfo\ServerInfo\DropList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElanPlateau extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_information_id',
        'title',
        'description',
    ];
}
