<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form1Answer extends Model
{
    protected $fillable = [
        'kode_fasyankes',
        'village_name',
        'year',
        'q1',
        'q2',
        'q3a',
        'q3b',
        'q4a',
        'q4b',
        'q5a',
        'q5b',
        'q6a',
        'q6b',
    ];

    protected $appends = [
        'q3average',
        'q3average80',
        'q4average',
        'q4average80',
        'q5average',
        'q5average80',
        'q6average',
        'q6average80',
        'summary',

        'score1',
        'score2',
        'score34',
        'score56',
    ];

    public function getQ3averageAttribute()
    {
        return round( (int) $this->q3b / (int) $this->q3a, 2 ); 
    }

    public function getQ3average80Attribute()
    {
        return (int) $this->getQ3averageAttribute() < 80 ? 'y' : 't'; 
    }

    public function getQ4averageAttribute()
    {
        return round( (int) $this->q4b / (int) $this->q4a, 2 ); 
    }

    public function getQ4average80Attribute()
    {
        return (int) $this->getQ4averageAttribute() < 80 ? 'y' : 't'; 
    }

    public function getQ5averageAttribute()
    {
        return round( (int) $this->q5b / (int) $this->q5a, 2 ); 
    }

    public function getQ5average80Attribute()
    {
        return (int) $this->getQ5averageAttribute() < 80 ? 'y' : 't'; 
    }

    public function getQ6averageAttribute()
    {
        return round( (int) $this->q6b / (int) $this->q6a, 2 ); 
    }

    public function getQ6average80Attribute()
    {
        return (int) $this->getQ6averageAttribute() < 80 ? 'y' : 't'; 
    }

    public function getSummaryAttribute()
    {
        $U = $this->getScore1Attribute();
        $V = $this->getScore2Attribute();
        $W = $this->getScore34Attribute();
        $X = $this->getScore56Attribute();

        // =IF(
        //     U12=1;
        //       "ORI";
        // IF(
        //     AND(U12<1;V12=1;W12=2);
        //       "ORI";
        // IF(
        //     AND(U12<1;V12=1;W12>0;X12>0);
        //       "ORI";
        //       "Tidak ORI")))

        // U 0
        // V 1
        // W 2
        // X 1


        if ($U == 1) {
            return "ORI";
        } elseif ($U < 1 && $V == 1 && $W == 2) {
            return "ORI";
        } elseif ($U < 1 && $V == 1 && $W > 0 && $X > 0) { // ⬅️ Harus W > 0 dan X > 0
            return "ORI";
        } else {
            return "Tidak ORI";
        }
    }

    public function getScore1Attribute()
    {
        return $this->q1 === 'y' ? 1 : 0; 
    }
    public function getScore2Attribute()
    {
        return $this->q2 === 'y' ? 1 : 0; 
    }

    public function getScore34Attribute()
    {
        return array_count_values([$this->getQ3average80Attribute(), $this->getQ4average80Attribute()])['y'] ?? 0;
    }
    public function getScore56Attribute()
    {
        return array_count_values([$this->getQ5average80Attribute(), $this->getQ6average80Attribute()])['y'] ?? 0;
    }

    public function fasyankes()
    {
        return $this->belongsTo(Fasyankes::class, 'kode_fasyankes', 'kode_fasyankes');
    }
}
