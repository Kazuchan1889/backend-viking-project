<?php

namespace App\Models\Donation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use App\Models\Donation\DonationInformation; 

class HowToDonation extends Model
{
    use HasFactory; 

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'how_to_donations'; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'donation_informations_id', 
        'title',
        'description',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
 
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function donationinformation() // <-- Relasi ke GameInformation
    {
        return $this->belongsTo(DonationInformation::class, 'donation_informations_id', 'id');
    }
}
