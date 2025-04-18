<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Skdr;
use App\Models\Notification;


class KlbAlert extends Widget
{

    protected static string $view = 'filament.widgets.klb-alert';

    protected static bool $isLazy = false;

    public $klbStatus = false;

    public $klb = [];

    public function getViewData(): array
    {

        $tahun = now()->format('Y'); 

        $data = Skdr::where('year', $tahun)
            ->orderBy('kode_fasyankes')
            ->with('fasyankes')
            ->orderBy('week');
        
        if (auth()->user()->hasRole('Puskesmas')) {
            $data->where('kode_fasyankes', auth()->user()->kode_fasyankes);
        }

        $data = $data->get()->groupBy('kode_fasyankes');

        $results = [];

        foreach ($data as $kodeFasyankes => $records) {
            $weeks = $records->pluck('case_count', 'week')->toArray(); 

            $fasyankesName = $records->first()->fasyankes->name;

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

                    $notification = Notification::with('fasyankes')
                        ->where('kode_fasyankes', $kodeFasyankes)
                        ->where('start_week', $w1)
                        ->where('category', 'klb')
                        ->where('end_week', $caseW4 
                                            ? $w4 
                                            : ($caseW3 
                                                ? $w3 
                                                : ($caseW2 
                                                    ? $w2 
                                                    : $w1))
                        )
                        ->where('total_case', $totalCases)
                        ->first();

                    if ($notification) {
                        
                        $results[] = [
                            'kode_fasyankes' => $notification->kode_fasyankes,
                            'fasyankes_name' => $notification->fasyankes->name,
                            'start_week' => $notification->start_week,
                            'end_week' => $notification->end_week,
                            'total_cases' => $notification->total_case,
                            'status' => $notification->status,
                        ];

                    } else {

                        $results[] = [
                            'kode_fasyankes' => $kodeFasyankes,
                            'fasyankes_name' => $fasyankesName,
                            'start_week' => $w1,
                            'end_week' => $caseW4 
                                            ? $w4 
                                            : ($caseW3 
                                                ? $w3 
                                                : ($caseW2 
                                                    ? $w2 
                                                    : $w1)),
                            'total_cases' => $totalCases,
                            'status' => 'unconfirmed',
                        ];

                    }

                }

            }

        }

        if ($results) {
            $this->klbStatus = true;
            $this->klb = $results;
        }

        return [];

        // return view('filament.widgets.klb-alert');
        
    }

    public function notification_confirm($kodeFasyankes, $totalCase, $startWeek, $endWeek, $status)
    {
        Notification::create([
            'kode_fasyankes' => $kodeFasyankes,
            'total_case' => $totalCase,
            'start_week' => $startWeek,
            'end_week' => $endWeek,
            'category' => 'klb',
            'status' => $status,
        ]);

        $this->dispatch('$refresh');

    }

}
