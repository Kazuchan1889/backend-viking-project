<?php

namespace App\Models\GameInfo\ServerInfo\DropList;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\ServerInfo\DropList\DropList;


class DropOnHq extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];
    public function questInformation()
    {
        return $this->belongsTo(DropList::class);
    }
}
