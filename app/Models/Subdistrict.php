<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    use HasFactory;

    protected $fillable = [
        'subdistrict_id', 'province_id', 'regency_id', 'name'
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'subdistrict_id', 'subdistrict_id');
    }

}
