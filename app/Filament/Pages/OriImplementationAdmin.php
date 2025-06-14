<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Fasyankes;
use App\Models\OriImplementation;

class OriImplementationAdmin extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.ori-implementation-admin';

    protected static ?string $navigationLabel = 'Hasil Pelaksanaan ORI';

    protected static ?string $slug = 'input-pelaksanaan-ori-admin';

    protected static ?string $label = 'Hasil Pelaksanaan ORI';

    protected static ?string $pluralModelLabel = 'Hasil Pelaksanaan ORI';

    protected static ?string $navigationGroup = 'PELAPORAN';

    protected static ?int $navigationSort = 4;

    protected static ?string $title = 'Hasil Pelaksanaan ORI';

    protected ?string $heading = 'Hasil Pelaksanaan ORI';

    public $reference_fasyankes;

    public $fasyankes = 'all';

    public $target_all, $target_male, $target_female, $immunized_child, $unimmunized_child;

    public $targetBasedCoverage, $targetBasedCoverageCategories, $targetBasedCoverageTotal, $targetBasedCoverageValues;
    public $genderBasedCoverage, $genderBasedCoverageCategories, $genderBasedCoverageTotal, $genderBasedCoverageValues;

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole(['Dinkes', 'Kemkes']); 
    }

    public function targetBasedCoverageData()
    {

        $targetBasedCoverage = OriImplementation::selectRaw('status, COUNT(*) as total');
            // ->when($this->fasyankes, fn($q, $kode) => $q->where('kode_fasyankes', $kode))
            // ->where('year', $this->year)
            // ->where('status', 'Hadir')
        if ($this->fasyankes && $this->fasyankes !== 'all') {
            $targetBasedCoverage->where('kode_fasyankes', $this->fasyankes);
        }
        $targetBasedCoverage->groupBy('status');

        
        
        $this->targetBasedCoverage = $targetBasedCoverage->pluck('total', 'status');



        // $this->targetBasedCoverageCategories = $this->targetBasedCoverage->keys()->map(function ($key) {
        //     return $key == 'Hadir' ? 'Cakupan Diimunisasi' : 'Cakupan Tidak Diimunisasi';
        // })->toArray();

        $this->targetBasedCoverageTotal = $this->targetBasedCoverage->sum();


        $this->targetBasedCoverageValues = $this->targetBasedCoverage
            ->map(function ($value, $key) { return [
                'name' => $key == 'Hadir' ? 'Cakupan Diimunisasi' : 'Cakupan Tidak Diimunisasi',
                'data' => [round($value/$this->targetBasedCoverageTotal*100)]
            ]; })->values();

        if (count($this->targetBasedCoverage) == 0) {
            $this->targetBasedCoverageValues = [
                [
                    'name' => '',
                    'data' => [],
                ]
            ];
        }

    }

    public function genderBasedCoverageData()
    {

        $genderBasedCoverage = OriImplementation::selectRaw('gender, COUNT(*) as total');
            // ->when($this->fasyankes, fn($q, $kode) => $q->where('kode_fasyankes', $kode))
            // ->where('year', $this->year)
            // ->where('status', 'Hadir')
        if ($this->fasyankes && $this->fasyankes !== 'all') {
            $genderBasedCoverage->where('kode_fasyankes', $this->fasyankes);
        }
        $genderBasedCoverage->groupBy('gender');

        $this->genderBasedCoverage = $genderBasedCoverage->pluck('total', 'gender');

        // $this->genderBasedCoverageCategories = $this->genderBasedCoverage->keys()->map(function ($key) {
        //     return $key == 'Hadir' ? 'Cakupan Diimunisasi' : 'Cakupan Tidak Diimunisasi';
        // })->toArray();

        $this->genderBasedCoverageTotal = $this->genderBasedCoverage->sum();


        $this->genderBasedCoverageValues = $this->genderBasedCoverage
            ->map(function ($value, $key) { return [
                'name' => $key == 'L' ? 'Laki-Laki' : 'Perempuan',
                'data' => [round($value/$this->genderBasedCoverageTotal*100)]
            ]; })->values();
        
        if (count($this->genderBasedCoverage) == 0) {
            $this->genderBasedCoverageValues = [
                [
                    'name' => '',
                    'data' => [],
                ]
            ];
        }

    }

    public function mount()
    {
        $this->reference_fasyankes = Fasyankes::select('kode_fasyankes', 'name')->pluck('name', 'kode_fasyankes');

        $data = OriImplementation::query();
        if ($this->fasyankes !== 'all') {
            $data->where('kode_fasyankes', $this->fasyankes);
        }
        $data = $data->get();

        $this->target_all = $data->count();
        $this->target_male = $data->where('gender', 'L')->count();
        $this->target_female = $data->where('gender', 'P')->count();
        $this->immunized_child = $data->where('status', 'Hadir')->count();
        $this->unimmunized_child = $data->where('status', 'Tidak Hadir')->count();

        $this->targetBasedCoverageData();
        $this->genderBasedCoverageData();

    }

    public function ChangeKodeFasyankes()
    {

        $data = OriImplementation::query();
        if ($this->fasyankes !== 'all') {
            $data->where('kode_fasyankes', $this->fasyankes);
        }
        $data = $data->get();

        $this->target_all = $data->count();
        $this->target_male = $data->where('gender', 'L')->count();
        $this->target_female = $data->where('gender', 'P')->count();
        $this->immunized_child = $data->where('status', 'Hadir')->count();
        $this->unimmunized_child = $data->where('status', 'Tidak Hadir')->count();

        $this->targetBasedCoverageData();
        $this->genderBasedCoverageData();

        $this->dispatch('changeKodeFasyankes');

    }

}
