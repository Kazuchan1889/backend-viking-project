<?php

namespace App\Models\GameInfo\ServerInfo\GeneralInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\GameInformation;

class SystemInformation extends Model
{
    use HasFactory;

    // Pastikan ini sesuai dengan nama tabel aslinya di database!
    protected $table = 'system_information';

    protected $fillable = [
        'game_information_id',
        'title',
        'description',
    ];

    public function gameInformation()
    {
        return $this->belongsTo(GameInformation::class, 'game_information_id');
    }
}
