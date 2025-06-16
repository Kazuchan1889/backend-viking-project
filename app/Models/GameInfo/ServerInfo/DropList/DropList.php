<?php

namespace App\Models\GameInfo\ServerInfo\DropList;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\MapInformation;

class DropList extends Model
{
    use HasFactory;

    protected $table = 'droplist'; 

    protected $fillable = [
        'droplist',           
        'buy_with',           
        'map_information_id', 
    ];

    /**
     * Relasi ke MapInformation (many-to-one)
     */
    public function mapInformation()
    {
        return $this->belongsTo(MapInformation::class, 'map_information_id', 'id');
    }
}
