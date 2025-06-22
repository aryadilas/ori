<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Fasyankes;
use App\Models\OriImplementation;
use App\Models\ViewOriImplementation;
use App\Models\Form3Answer;

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

    public $reference_fasyankes, $reference_village;

    // public $fasyankes = 'all';
    // public $village = 'all';
    public $fasyankes = 'all';
    public $village = 'all';

    public $target_all, $target_male, $target_female, $immunized_child, $unimmunized_child;

    public $targetBasedCoverage, $targetBasedCoverageCategories, $targetBasedCoverageTotal, $targetBasedCoverageValues;
    public $genderBasedCoverage, $genderBasedCoverageCategories, $genderBasedCoverageTotal, $genderBasedCoverageValues;

    public $sasaran_imunisasi, $anak_imunisasi, $persen_cakupan_ori, $cakupan_sasaran, $cakupan_usia_9_18, $cakupan_usia_18_59, $cakupan_usia_5_7, $cakupan_usia_7_13, $cakupan_usia_13_16;

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
        if ($this->village && $this->village !== 'all') {
            $targetBasedCoverage->where('village_name', $this->village);
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
        if ($this->village && $this->village !== 'all') {
            $genderBasedCoverage->where('village_name', $this->village);
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

    public function preparingData()
    {


        $this->reference_fasyankes = Fasyankes::select('kode_fasyankes', 'name')->pluck('name', 'kode_fasyankes');
        
        $form3_data = Form3Answer::query();
        if ($this->fasyankes !== 'all') {
            $form3_data->where('kode_fasyankes', $this->fasyankes);
        }
        if ($this->village !== 'all') {
            $form3_data->where('village_name', $this->village);
        }
        $form3_data = $form3_data->get();

        $implement_data = ViewOriImplementation::query();
        if ($this->fasyankes !== 'all') {
            $implement_data->where('kode_fasyankes', $this->fasyankes);
        }
        if ($this->village !== 'all') {
            $implement_data->where('village_name', $this->village);
        }
        $implement_data = $implement_data->get();

        $this->reference_village = $implement_data->pluck('village_name', 'village_name');

        
        $this->sasaran_imunisasi = $form3_data->where('age_group', '!=', '≥ 16 tahun')->sum('village_target');
        $this->anak_imunisasi = $implement_data->where('age_group', '!=', '≥ 16 tahun')->count();

        if ($this->sasaran_imunisasi == 0) {
            $this->persen_cakupan_ori = 0;
            $this->cakupan_sasaran = [
                [
                    'name' => '',
                    'data' => [],
                ]
            ];
        } else {
            
            $this->persen_cakupan_ori = round(($this->anak_imunisasi/$this->sasaran_imunisasi) * 100, 1);
            $this->cakupan_sasaran = [
                [
                    'name' => 'Imunisasi',
                    'data' => [$this->persen_cakupan_ori]
                ],
                [
                    'name' => 'Tidak Imunisasi',
                    'data' => [100-$this->persen_cakupan_ori]
                ]
            ];

        }

        if ($form3_data->where('age_group', '9 - <18 bulan')->sum('village_target') == 0) {
            $this->cakupan_usia_9_18 = [
                [
                    'name' => '',
                    'data' => [],
                ]
            ];
        } else {
            $persen_cakupan_usia_9_18 = round(($implement_data->where('age_group', '9 - <18 bulan')->count() / $form3_data->where('age_group', '9 - <18 bulan')->sum('village_target')) * 100, 1);
            $this->cakupan_usia_9_18 = [
                [
                    'name' => 'Imunisasi 9 - <18 bulan',
                    'data' => [$persen_cakupan_usia_9_18]
                ],
                [
                    'name' => 'Tidak Imunisasi 9 - <18 bulan',
                    'data' => [100-$persen_cakupan_usia_9_18]
                ]
            ];
        }

        if ($form3_data->where('age_group', '18 - 59 bulan')->sum('village_target') == 0) {
            $this->cakupan_usia_18_59 = [
                [
                    'name' => '',
                    'data' => [],
                ]
            ];
        } else {
            $persen_cakupan_usia_18_59 = round(($implement_data->where('age_group', '18 - 59 bulan')->count() / $form3_data->where('age_group', '18 - 59 bulan')->sum('village_target')) * 100, 1);
            $this->cakupan_usia_18_59 = [
                [
                    'name' => 'Imunisasi 18 - 59 bulan',
                    'data' => [$persen_cakupan_usia_18_59]
                ],
                [
                    'name' => 'Tidak Imunisasi 18 - 59 bulan',
                    'data' => [100-$persen_cakupan_usia_18_59]
                ]
            ];
        }

        if ($form3_data->where('age_group', '5 - <7 tahun')->sum('village_target') == 0) {
            $this->cakupan_usia_5_7 = [
                [
                    'name' => '',
                    'data' => [],
                ]
            ];
        } else {
            $persen_cakupan_usia_5_7 = round(($implement_data->where('age_group', '5 - <7 tahun')->count() / $form3_data->where('age_group', '5 - <7 tahun')->sum('village_target')) * 100, 1);
            $this->cakupan_usia_5_7 = [
                [
                    'name' => 'Imunisasi 5 - <7 tahun',
                    'data' => [$persen_cakupan_usia_5_7]
                ],
                [
                    'name' => 'Tidak Imunisasi 5 - <7 tahun',
                    'data' => [100-$persen_cakupan_usia_5_7]
                ]
            ];
        }

        if ($form3_data->where('age_group', '7 - <13 tahun')->sum('village_target') == 0) {
            $this->cakupan_usia_7_13 = [
                [
                    'name' => '',
                    'data' => [],
                ]
            ];
        } else {
            $persen_cakupan_usia_7_13 = round(($implement_data->where('age_group', '7 - <13 tahun')->count() / $form3_data->where('age_group', '7 - <13 tahun')->sum('village_target')) * 100, 1);
            $this->cakupan_usia_7_13 = [
                [
                    'name' => 'Imunisasi 7 - <13 tahun',
                    'data' => [$persen_cakupan_usia_7_13]
                ],
                [
                    'name' => 'Tidak Imunisasi 7 - <13 tahun',
                    'data' => [100-$persen_cakupan_usia_7_13]
                ]
            ];
        }

        if ($form3_data->where('age_group', '13 - <16 tahun')->sum('village_target') == 0) {
            $this->cakupan_usia_13_16 = [
                [
                    'name' => '',
                    'data' => [],
                ]
            ];
        } else {
            $persen_cakupan_usia_13_16 = round(($implement_data->where('age_group', '13 - <16 tahun')->count() / $form3_data->where('age_group', '13 - <16 tahun')->sum('village_target')) * 100, 1);
            $this->cakupan_usia_13_16 = [
                [
                    'name' => 'Imunisasi 13 - <16 tahun',
                    'data' => [$persen_cakupan_usia_13_16]
                ],
                [
                    'name' => 'Tidak Imunisasi 13 - <16 tahun',
                    'data' => [100-$persen_cakupan_usia_13_16]
                ]
            ];
        }

    }

    public function mount()
    {
        
        $this->preparingData();



        // $data = OriImplementation::query();
        // if ($this->fasyankes !== 'all') {
        //     $data->where('kode_fasyankes', $this->fasyankes);
        // }
        // if ($this->village !== 'all') {
        //     $data->where('village_name', $this->village);
        // }
        // $data = $data->get();

        

        // $this->target_all = $data->count();
        // $this->target_male = $data->where('gender', 'L')->count();
        // $this->target_female = $data->where('gender', 'P')->count();
        // $this->immunized_child = $data->where('status', 'Hadir')->count();
        // $this->unimmunized_child = $data->where('status', 'Tidak Hadir')->count();

        // $this->targetBasedCoverageData();
        // $this->genderBasedCoverageData();

    }

    public function ChangeKodeFasyankes()
    {

        // $data = OriImplementation::query();
        // if ($this->fasyankes !== 'all') {
        //     $data->where('kode_fasyankes', $this->fasyankes);
        // }
        // $data = $data->get();


        // $this->reference_village = $data->pluck('village_name', 'village_name');

        // $this->target_all = $data->count();
        // $this->target_male = $data->where('gender', 'L')->count();
        // $this->target_female = $data->where('gender', 'P')->count();
        // $this->immunized_child = $data->where('status', 'Hadir')->count();
        // $this->unimmunized_child = $data->where('status', 'Tidak Hadir')->count();

        // $this->targetBasedCoverageData();
        // $this->genderBasedCoverageData();
        $this->preparingData();
        $this->dispatch('changeKodeFasyankes');

    }

    public function ChangeVillage()
    {

        // $data = OriImplementation::query();
        // if ($this->fasyankes !== 'all') {
        //     $data->where('kode_fasyankes', $this->fasyankes);
        // }
        // if ($this->village !== 'all') {
        //     $data->where('village_name', $this->village);
        // }
        // $data = $data->get();

        // $this->target_all = $data->count();
        // $this->target_male = $data->where('gender', 'L')->count();
        // $this->target_female = $data->where('gender', 'P')->count();
        // $this->immunized_child = $data->where('status', 'Hadir')->count();
        // $this->unimmunized_child = $data->where('status', 'Tidak Hadir')->count();

        // $this->targetBasedCoverageData();
        // $this->genderBasedCoverageData();
        $this->preparingData();
        $this->dispatch('changeKodeFasyankes');

    }

}
