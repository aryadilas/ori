<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Form2Answer;

class DataVisualisation extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static string $view = 'filament.pages.data-visualisation';

    protected static ?string $navigationLabel = 'Visualisasi Data';

    protected static ?string $slug = 'visualisasi-data';

    protected static ?string $label = 'Visualisasi Data';

    protected static ?string $pluralModelLabel = 'Visualisasi Data';

    
    protected static ?string $title = 'Visualisasi Data';

    protected ?string $heading = 'Visualisasi Data';

    protected ?string $subheading = 'Halaman untuk melihat visualisasi data.';

    public $immunizedInfo, $immunizedInfoCategories, $immunizedInfoValues, $immunizedInfoTotal;
    public $notImmunizedReason, $notImmunizedReasonCategories, $notImmunizedReasonValues, $notImmunizedReasonTotal;
    public $fever14Days, $fever14DaysCategories, $fever14DaysValues, $fever14DaysTotal;
    public $immunizedParentPermission, $immunizedParentPermissionCategories, $immunizedParentPermissionValues, $immunizedParentPermissionTotal;

    public $tab;
    
    public function mount()
    {
        /* immunizedInfo */
        $this->immunizedInfo = Form2Answer::selectRaw('q7, COUNT(*) as total')
            ->where('kode_fasyankes', auth()->user()->kode_fasyankes)
            ->groupBy('q7')
            ->pluck('total', 'q7');

        $this->immunizedInfoCategories = $this->immunizedInfo->keys()->map(function ($key) {
            return explode(' ', $key);
        })->toArray();

        $this->immunizedInfoTotal = $this->immunizedInfo->sum();


        $this->immunizedInfoValues = $this->immunizedInfo
            ->values()
            ->map(function ($key) { return round($key/$this->immunizedInfoTotal*100); })
            ->toArray();


        /* notImmunizedReason */
        $this->notImmunizedReason = Form2Answer::selectRaw('q5, COUNT(*) as total')
            ->where('kode_fasyankes', auth()->user()->kode_fasyankes)
            ->groupBy('q5')
            ->pluck('total', 'q5');

        $this->notImmunizedReasonCategories = $this->notImmunizedReason->keys()->map(function ($key) {
            return explode(' ', $key);
        })->toArray();

        $this->notImmunizedReasonTotal = $this->notImmunizedReason->sum();


        $this->notImmunizedReasonValues = $this->notImmunizedReason
            ->values()
            ->map(function ($key) { return round($key/$this->notImmunizedReasonTotal*100); })
            ->toArray();

        /* fever14Days */
        $this->fever14Days = Form2Answer::selectRaw('q8, COUNT(*) as total')
            ->where('kode_fasyankes', auth()->user()->kode_fasyankes)
            ->groupBy('q8')
            ->pluck('total', 'q8');

        $this->fever14DaysCategories = $this->fever14Days->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->fever14DaysTotal = $this->fever14Days->sum();


        $this->fever14DaysValues = $this->fever14Days
            ->values()
            ->map(function ($key) { return round($key/$this->fever14DaysTotal*100); })
            ->toArray();

        /* immunizedParentPermission */
        $this->immunizedParentPermission = Form2Answer::selectRaw('q6, COUNT(*) as total')
            ->where('kode_fasyankes', auth()->user()->kode_fasyankes)
            ->groupBy('q6')
            ->pluck('total', 'q6');

        $this->immunizedParentPermissionCategories = $this->immunizedParentPermission->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->immunizedParentPermissionTotal = $this->immunizedParentPermission->sum();


        $this->immunizedParentPermissionValues = $this->immunizedParentPermission
            ->values()
            ->map(function ($key) { return round($key/$this->immunizedParentPermissionTotal*100); })
            ->toArray();

    }

}
