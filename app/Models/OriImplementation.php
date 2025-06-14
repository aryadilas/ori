<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OriImplementation extends Model
{

    protected $fillable = [
        'id',
        'kode_fasyankes',
        'village_name',
        'child_name',
        'birthday',
        'gender',
        'child_nik',
        'parent_name',
        'parent_nik',
        'address',
        'telp',
        'status',
    ];

    protected $appends = [
        'age',
    ];

    public function getAgeAttribute()
    {

        $birthDate = Carbon::parse($this->birthday)->startOfDay();
        $currentDate = Carbon::now();

        $age = $currentDate->diffInYears($birthDate);
        return $age;

    }

    public function fasyankes()
    {
        return $this->belongsTo(Fasyankes::class, 'kode_fasyankes', 'kode_fasyankes');
    }

}
