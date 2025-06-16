<?php

namespace App\Models\GameInfo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo\FeaturesDisable; // Import model FeaturesDisable
use App\Models\GameInfo\ServerInfo\GeneralInfo\FeaturesInfo\FeaturesEnable; // Import model FeaturesEnable

class GameInformation extends Model
{
    use HasFactory;

    protected $table = 'game_informations'; 

    protected $fillable = [
        'name', 
        // Tambahkan kolom lain jika ada di tabel game_informations yang ingin bisa diisi massal
    ];

    protected $casts = [
        // 'created_at' => 'datetime', 
        // 'updated_at' => 'datetime',
    ];

    public $timestamps = true; 

    public function featuresEnable()
    {
        return $this->hasMany(FeaturesEnable::class, 'game_information_id', 'id');
    }

    public function featuresDisable()
    {
        return $this->hasMany(FeaturesDisable::class, 'game_information_id', 'id');
    }
}