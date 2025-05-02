<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Form2ImunizedReason;
use App\Enums\ImunizedInformationSource;
use Carbon\Carbon;

class Form2Answer extends Model
{

    protected $casts = [
        'q5' => Form2ImunizedReason::class,
        'q7' => ImunizedInformationSource::class,
    ];

    protected $fillable = [
        'house_id',
        'kode_fasyankes',
        'village_name',
        'year',
        'parent_nik',
        'parent_name',
        'child_nik',
        'child_name',
        'birthdate',
        'gender',
        'q1',
        'q2',
        'q3',
        'q4',
        'q5',
        'q6',
        'q7',
        'q8',
        'q9',
    ];

    protected $appends = [
        'monthAge',
        'ageHelper',
        'ageCategory',
        'birthYear',
        'rubela2Target',
    ];

    public function getMonthAgeAttribute()
    {
        $birthdate = Carbon::parse($this->birthdate);

        $monthAge = $birthdate->diffInMonths(now());

        return intval($monthAge);
    }

    public function getAgeHelperAttribute()
    {

        $monthAge = $this->getMonthAgeAttribute();
        if ($monthAge < 72 && $monthAge > 59) {
            return '1';
        } elseif ($monthAge < 84 && $monthAge >= 72) {
            return '2';
        } else {
            return '0';
        }

    }

    public function getAgeCategoryAttribute()
    {

        $monthAge = $this->getMonthAgeAttribute();

        if ($monthAge >= 2 && $monthAge < 18) {
            return '1';
        } elseif ($monthAge <= 59 && $monthAge >= 18) {
            return '2';
        } elseif ($monthAge < 84 && $monthAge >= 60) {
            return '3';
        } elseif ($monthAge < 156 && $monthAge >= 84) {
            return '4';
        } elseif ($monthAge < 192 && $monthAge >= 156) {
            return '5';
        } else {
            return '0';
        }

    }

    public function getBirthYearAttribute()
    {

        return Carbon::parse($this->birthdate)->format('Y');

    }

    public function getRubela2TargetAttribute()
    {

        $g = $this->getAgeCategoryAttribute();
        $h = $this->getBirthYearAttribute();
        $i = $this->gender == 'l' ? '1' : '2'; 

        if ($g == 4 && $h > 2012) {
            return "1";
        } elseif ($g == 5 && $i > 2012) {
            return "2";
        } else {
            return "0";
        }

    }

    public function fasyankes()
    {
        return $this->belongsTo(Fasyankes::class, 'kode_fasyankes', 'kode_fasyankes');
    }


}
