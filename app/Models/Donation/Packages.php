<?php

namespace App\Models\Donation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameInfo\Items; 
use App\Models\Donation\PackageCategory; 
use App\Models\Donation\PackageBonus; 

class Packages extends Model
{
    use HasFactory;

    protected $table = 'packages';

    protected $fillable = [
        'package_name',
        'category_id',
        'items_id', 
        'price',
        'is_bonus_package',
    ];

    public function category()
    {
        return $this->belongsTo(PackageCategory::class, 'category_id');
    }

    public function bonuses()
    {
        return $this->hasMany(PackageBonus::class, 'package_id');
    }

    public function mainPackages()
    {
        return $this->hasMany(PackageBonus::class, 'bonus_package_id');
    }

    
    public function item() 
    {
        return $this->belongsTo(Items::class, 'items_id');
    }
}