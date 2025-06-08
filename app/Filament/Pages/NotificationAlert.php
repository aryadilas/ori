<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Facades\Filament;
use App\Models\Skdr;
use App\Models\Notification;

class NotificationAlert extends Page
{

    protected static string $view = 'filament.pages.notification-alert';

    protected static ?string $title = 'Notifikasi Alert KLB Campak-Rubela';

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    protected static ?string $navigationLabel = 'Status KLB';

    // public static function getNavigationBadge(): ?string
    // {



    //     $tahun = now()->format('Y'); 

    //     $data = Skdr::where('year', $tahun)
    //         ->orderBy('kode_fasyankes')
    //         ->with('fasyankes')
    //         ->orderBy('week');
        
    //     if (auth()->user()->hasRole('Puskesmas')) {
    //         $data->where('kode_fasyankes', auth()->user()->kode_fasyankes);
    //     }

    //     $data = $data->get()->groupBy('kode_fasyankes');

    //     $results = [];

    //     foreach ($data as $kodeFasyankes => $records) {
    //         $weeks = $records->pluck('case_count', 'week')->toArray(); 

    //         $fasyankesName = $records->first()->fasyankes->name;

    //         $allWeeks = array_keys($weeks);
    //         sort($allWeeks);

    //         for ($i = 0; $i < count($allWeeks); $i++) {
    //             $w1 = $allWeeks[$i];
    //             $w2 = $w1 + 1;
    //             $w3 = $w1 + 2;
    //             $w4 = $w1 + 3;

    //             $caseW1 = $weeks[$w1] ?? 0;
    //             $caseW2 = $weeks[$w2] ?? 0;
    //             $caseW3 = $weeks[$w3] ?? 0;
    //             $caseW4 = $weeks[$w4] ?? 0;

    //             $totalCases = $caseW1 + $caseW2 + $caseW3 + $caseW4;

    //             if ($caseW1 == 0 || $caseW2 == 0 || $caseW3 == 0 || $caseW4 == 0) {
    //                 continue;                    
    //             }

    //             if ($totalCases >= 5) {

    //                 $notification = Notification::with('fasyankes')
    //                     ->where('kode_fasyankes', $kodeFasyankes)
    //                     ->where('start_week', $w1)
    //                     ->where('category', 'klb')
    //                     ->where('end_week', $caseW4 
    //                                         ? $w4 
    //                                         : ($caseW3 
    //                                             ? $w3 
    //                                             : ($caseW2 
    //                                                 ? $w2 
    //                                                 : $w1))
    //                     )
    //                     ->where('total_case', $totalCases)
    //                     ->first();

    //                 if (!$notification) {

    //                     $results[] = [
    //                         'notification_id' => null,
    //                         'kode_fasyankes' => $kodeFasyankes,
    //                         'fasyankes_name' => $fasyankesName,
    //                         'start_week' => $w1,
    //                         'end_week' => $caseW4 
    //                                         ? $w4 
    //                                         : ($caseW3 
    //                                             ? $w3 
    //                                             : ($caseW2 
    //                                                 ? $w2 
    //                                                 : $w1)),
    //                         'total_cases' => $totalCases,
    //                         'status' => 'unconfirmed',
    //                     ];

    //                 } 

    //             }

    //         }

    //     }

    //     if ($results) {
    //         return 'NEW';
    //     }

    //     return '';

    // }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }


    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return Filament::getWidgets();
    }

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getVisibleWidgets(): array
    {
        return $this->filterVisibleWidgets($this->getWidgets());
    }

    /**
     * @return int | string | array<string, int | string | null>
     */
    public function getColumns(): int | string | array
    {
        return 3;
    }

}
