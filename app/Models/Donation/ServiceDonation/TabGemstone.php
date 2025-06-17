<?php

namespace App\Models\Donation\ServiceDonation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TabGemstone extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_title',
        'pricing',
    ];

}
