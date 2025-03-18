<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\FasyankesType;

class Fasyankes extends Model
{
    protected $casts = [
        'type' => FasyankesType::class,
    ];

    protected $fillable = [
        'kode_fasyankes',
        'name',
        'type',
        'regency',
        'longitude',
        'latitude',
    ];

}
