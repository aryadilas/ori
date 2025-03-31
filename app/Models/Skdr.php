<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fasyankes;

class Skdr extends Model
{

    protected $casts = [
        'patient_names' => 'array',
    ];

    protected $fillable = [
        'officer_name',
        'week',
        'year',
        'case_count',
        'patient_names',
        'kode_fasyankes'
    ];

    public function fasyankes()
    {
        return $this->belongsTo(Fasyankes::class, 'kode_fasyankes', 'kode_fasyankes');
    }

}
