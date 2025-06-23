<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Skdr;
use App\Models\Notification;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Subdistrict;
use App\Models\Fasyankes;


class KlbAlert extends Widget
{

    protected static string $view = 'filament.widgets.klb-alert';

    protected static bool $isLazy = false;

    public $klbStatus = false;

    public $klb = [];

    public $years, $provinces, $regencies, $subdistricts, $puskesmas;
    public $year_value = 2025; 
    public $province_value = '32'; 
    public $regency_value = '3276'; 
    public $subdistrict_value = 'all'; 
    public $puskes_value = 'all';

    public $alerts;

    public static function canView(): bool
    {
        return auth()->user()->hasRole(['Kemkes', 'Dinkes']);
    }

    public function getViewData(): array
    {
        
        $this->years = Notification::selectRaw('YEAR(created_at) as year')->get()->pluck('year', 'year');
        if (!$this->years) {
            $this->years[now()->year] = now()->year;
        }

        $this->provinces = Province::get()->pluck('name', 'province_id');
        $this->regencies = Regency::where('province_id', $this->province_value)->get()->pluck('name', 'regency_id');
        $this->subdistricts = Subdistrict::where('regency_id', $this->regency_value)->get()->pluck('name', 'subdistrict_id');

        $puskesmas = Fasyankes::query();
        if ($this->subdistrict_value && $this->subdistrict_value !== 'all') {
            $puskesmas->where('subdistrict_id', $this->subdistrict_value);
        }
        if ($this->subdistrict_value && $this->subdistrict_value === 'all') {
            $puskesmas->whereIn('subdistrict_id', $this->subdistricts->keys());
        }
        $this->puskesmas = $puskesmas->get()->pluck('name', 'kode_fasyankes');
        // $this->alerts = Notification::get();



        $alert = Notification::with('fasyankes')
            ->where('category', 'klb');

        if ($this->puskes_value && $this->puskes_value !== 'all') {
            $alert->where('kode_fasyankes', '=', $this->puskes_value);
        }

        if ($this->puskes_value && $this->puskes_value == 'all') {
            $alert->whereIn('kode_fasyankes', $this->puskesmas->keys());
        }

        if ($this->subdistrict_value && $this->subdistrict_value !== 'all') {
            $alert->whereRelation('fasyankes', 'subdistrict_id', '=', $this->subdistrict_value);
        }

        if ($this->year_value) {
            $alert->whereYear('created_at', '=', $this->year_value);
        }

        $this->alerts = $alert->get();

        return [];


    }

    public function subdistrict_change()
    {

        $this->puskes_value = 'all';

    }

    public function province_change()
    {
        $this->regencies = Regency::where('province_id', $this->province_value)->get()->pluck('name', 'regency_id');
        $this->regency_value = $this->regencies->keys()->first();
    }



    // public function getViewData(): array
    // {

        
        // $results = Notification::with('fasyankes')
        //     ->where('category', 'klb')
        //     // ->whereRelation('fasyankes', 'subdistrict_id', '=', $this->subdistrict_value)
        //     ->where('kode_fasyankes', '=', $this->puskes_value);

        
        // if (auth()->user()->hasRole('Puskesmas')) {
        //     $results->where('kode_fasyankes', auth()->user()->kode_fasyankes);
        // }

        // $results = $results->get();
       

        // if ($results) {
        //     $this->klbStatus = true;
        //     $this->klb = $results;
        // }

        // return [];

        
    // }

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
        $this->dispatch('hide-confirm-button');

    }

    public function notification_confirm_edit($notificationId, $status)
    {

        $notification = Notification::where('id', $notificationId)->first();
        
        if ($notification) {
            $notification->update([
                'status' => $status,
            ]);
        }

        $this->dispatch('$refresh');
        $this->dispatch('hide-confirm-button');

    }

}
