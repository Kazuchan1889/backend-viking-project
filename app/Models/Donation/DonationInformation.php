<?php

namespace App\Models\Donation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Donation\RetailDonation;
use App\Models\Donation\ServiceDonation\ServiceDonation;
use App\Models\Donation\SeassonPassDonation; 
use App\Models\Donation\PackageDonation;
use App\Models\Donation\HowToDonation;

class DonationInformation extends Model
{
    use HasFactory;

    protected $table = 'donation_informations';

    protected $fillable = [
        'name',
    ];

    public function retailDonations()
    {
        return $this->hasMany(RetailDonation::class);
    }

    public function serviceDonations()
    {
        return $this->hasMany(ServiceDonation::class);
    }

    public function seasonPassDonations()
    {
        return $this->hasMany(SeassonPassDonation::class);
    }

    public function packageDonations()
    {
        return $this->hasMany(PackageDonation::class);
    }

    public function howToDonations()
    {
        return $this->hasMany(HowToDonation::class);
    }
}
