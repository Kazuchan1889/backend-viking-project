<?php

namespace App\Models\Donation\ServiceDonation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabResources extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_title',
        'pricing',
    ];
}
