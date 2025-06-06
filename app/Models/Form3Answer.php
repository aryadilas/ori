<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form3Answer extends Model
{

    protected $fillable = [
        'kode_fasyankes',
        'year',
        'age_group',
        'suspect',
        'population',
        'village_name',
        'vaccine_target',
        'coverage_target',
        'village_target',
        'subdistrict_target',
    ];

    protected $appends = [
        'attackRate',
    ];

    public function fasyankes()
    {
        return $this->belongsTo(Fasyankes::class, 'kode_fasyankes', 'kode_fasyankes');
    }

    public function getAttackRateAttribute()
    {
        return round( ($this->suspect / $this->population) * 100, 2 );
    }


}
