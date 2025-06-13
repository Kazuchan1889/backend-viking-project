<?php

namespace App\Models\Donation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationInformation extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'donation_informations'; // Menentukan nama tabel di database (plural dengan 's')

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // Hanya kolom 'name' yang boleh diisi secara massal
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'created_at' => 'datetime', // Opsional: jika ingin secara eksplisit mengelola datetime
        // 'updated_at' => 'datetime',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true; // Mengaktifkan otomatisasi created_at dan updated_at
}
