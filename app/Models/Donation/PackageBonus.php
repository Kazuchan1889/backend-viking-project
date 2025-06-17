<?php

namespace App\Models\Donation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\Items;   // Pastikan ini di-import
use App\Models\Donation\Packages; // Pastikan ini di-import

class PackageBonus extends Model
{
    use HasFactory;

    // Laravel secara default mengasumsikan nama tabel adalah 'package_bonuses'.
    // Jika nama tabel Anda berbeda, definisikan di sini:
    // protected $table = 'nama_tabel_anda';

    protected $fillable = ['package_id', 'bonus_package_id'];

    /**
     */
    public function mainPackage()
    {
        return $this->belongsTo(Packages::class, 'package_id');
    }
    public function bonusPackage()
    {
        return $this->belongsTo(Packages::class, 'bonus_package_id');
    }
    public function items()
    {
        return $this->belongsToMany(Items::class, 'item_package_bonus', 'package_bonus_id', 'items_id');
    }
}