<?php

namespace App\Models\GameInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerRules extends Model
{
    use HasFactory;

    protected $fillable = [
        'rules',
        'category',
        'description',
    ];
}
