<?php

namespace App\Models\Donation;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = ['title'];

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
