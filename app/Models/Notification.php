<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $fillable = [
        'kode_fasyankes',
        'total_case',
        'start_week',
        'end_week',
        'category',
        'status',
    ];

    public function fasyankes()
    {
        return $this->belongsTo(Fasyankes::class, 'kode_fasyankes', 'kode_fasyankes');
    }

    

}
