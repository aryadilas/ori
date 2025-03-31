<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Skdr;


class KlbAlert extends Widget
{

    protected static string $view = 'filament.widgets.klb-alert';

    protected static bool $isLazy = false;

    public $klbStatus = false;

    public $klb = [];

    public function mount()
    {

        $tahun = now()->format('Y'); 

        $data = Skdr::where('year', $tahun)
            ->where('kode_fasyankes', auth()->user()->kode_fasyankes)
            ->orderBy('kode_fasyankes')
            ->orderBy('week')
            ->get()
            ->groupBy('kode_fasyankes');



        $results = [];

        foreach ($data as $kodeFasyankes => $records) {
            $weeks = $records->pluck('case_count', 'week')->toArray(); 

            $allWeeks = array_keys($weeks);
            sort($allWeeks);

            for ($i = 0; $i < count($allWeeks) - 3; $i++) {
                $w1 = $allWeeks[$i];
                $w2 = $w1 + 1;
                $w3 = $w1 + 2;
                $w4 = $w1 + 3;

                $caseW1 = $weeks[$w1] ?? 0;
                $caseW2 = $weeks[$w2] ?? 0;
                $caseW3 = $weeks[$w3] ?? 0;
                $caseW4 = $weeks[$w4] ?? 0;


                $totalCases = $caseW1 + $caseW2 + $caseW3 + $caseW4;

                if ($totalCases >= 5) {
                    $results[] = [
                        'kode_fasyankes' => $kodeFasyankes,
                        'start_week' => $w1,
                        'end_week' => $w4,
                        'total_cases' => $totalCases
                    ];
                }

            }

        }

        if ($results) {
            $this->klbStatus = true;
            $this->klb = $results;
        }
        
    }

}
