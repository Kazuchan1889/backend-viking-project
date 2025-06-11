<?php

namespace App\Models\Donation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeassonPassDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id', // foreign key
        'title',
        'pricing',
        'description',
        'timestamps',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
