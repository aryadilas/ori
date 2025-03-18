<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
