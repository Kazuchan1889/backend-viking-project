<?php

namespace App\Models\GameInfo\ServerInfo\GeneralInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemInformation extends Model
{
    use HasFactory;

    protected $table = 'system_information';

    protected $fillable = [
        'system_info',
        'description',
    ];
}
