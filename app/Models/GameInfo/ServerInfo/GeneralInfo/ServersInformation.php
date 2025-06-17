<?php

namespace App\Models\GameInfo\ServerInfo\GeneralInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServersInformation extends Model
{
    use HasFactory;

    protected $table = 'serversinformations'; 

    protected $fillable = [
        'server_info',
        'description',
    ];
}
