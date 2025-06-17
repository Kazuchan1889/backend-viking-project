<?php

namespace App\Models\GameInfo\ServerInfo\DropList;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\MapInformation;
use App\Models\GameInfo\Items;

class DropList extends Model
{
    use HasFactory;

    protected $table = 'droplist'; 

    protected $fillable = [
        'monster',
        'items_id',
        'map_information_id',
    ];

    public function item()
    {
        return $this->belongsTo(Items::class, 'items_id');
    }

    public function mapInformation()
    {
        return $this->belongsTo(MapInformation::class, 'map_information_id');
    }
}