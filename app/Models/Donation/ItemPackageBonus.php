<?php

namespace App\Models\Donation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\Items;        // Pastikan ini di-import
use App\Models\Donation\PackageBonus; // Pastikan ini di-import

class ItemPackageBonus extends Model
{
    use HasFactory;

    protected $table = 'item_package_bonus';

    protected $fillable = ['package_bonus_id', 'items_id'];
    public function packageBonus()
    {
        return $this->belongsTo(PackageBonus::class, 'package_bonus_id');
    }
    public function item() // <-- Nama relasi yang benar (singular)
    {
        return $this->belongsTo(Items::class, 'items_id');
    }
}