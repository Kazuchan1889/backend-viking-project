<?php

namespace App\Models\GameInfo;

use App\Models\GameInfo\ServerInfo\DropList\DropList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Donation\PackageBonus;


class Items extends Model
{
    use HasFactory;

    protected $fillable = ['items_name'];

    public function packageBonuses()
    {
        return $this->belongsToMany(PackageBonus::class, 'item_package_bonus', 'item_id', 'package_bonus_id');
    }

    public function dropList()
    {
        return $this->belongsToMany(DropList::class, 'droplist', 'item_id', 'droplist_id');
    }
}
