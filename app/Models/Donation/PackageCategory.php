<?php

namespace App\Models\Donation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_name'];

    public function packages()
    {
        return $this->hasMany(Packages::class, 'category_id');
    }
}
