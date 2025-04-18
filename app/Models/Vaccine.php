<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vaccine extends Model
{

    use HasFactory;

    protected $fillable = [
        'month',
        'year',
        'category',
        'amount',
        'kode_fasyankes'
    ];

    public static function getTotalStok($kodeFasyankes, $year)
    {
        // Mengambil semua vaksin berdasarkan kode_fasyankes dan tahun
        $vaccines = self::where('kode_fasyankes', $kodeFasyankes)
            ->where('year', $year)
            ->get();

        // Menghitung total stok
        $total = 0;

        foreach ($vaccines as $vaccine) {
            if ($vaccine->category === 'penambahan') {
                $total += $vaccine->amount; // Tambah jika kategori 'penambahan'
            } elseif ($vaccine->category === 'pengurangan') {
                $total -= $vaccine->amount; // Kurangi jika kategori 'pengurangan'
            }
        }

        return $total;
    }

    public function fasyankes()
    {
        return $this->belongsTo(Fasyankes::class, 'kode_fasyankes', 'kode_fasyankes');
    }

}
