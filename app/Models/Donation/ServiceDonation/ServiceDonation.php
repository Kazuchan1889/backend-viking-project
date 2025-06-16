<?php

namespace App\Models\Donation\ServiceDonation;

use App\Models\Donation\DonationInformation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_informations_id', 
        'title',
        'description',
        'pricing',
    ];

    public function donation()
    {
        return $this->belongsTo(DonationInformation::class);
    }
}
