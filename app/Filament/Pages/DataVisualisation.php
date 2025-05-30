<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Form2Answer;
use App\Models\Form1Answer;
use App\Models\Fasyankes;
use App\Models\ViewSummarySckOri;

class DataVisualisation extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static string $view = 'filament.pages.data-visualisation';

    protected static ?string $navigationLabel = 'Visualisasi Data';

    protected static ?string $slug = 'visualisasi-data';

    protected static ?string $label = 'Visualisasi Data';

    protected static ?string $pluralModelLabel = 'Visualisasi Data';

    protected static ?string $navigationGroup = 'VISUALISASI DATA';

    
    protected static ?string $title = 'Visualisasi Data';

    protected ?string $heading = 'Visualisasi Data';

    protected ?string $subheading = 'Halaman untuk melihat visualisasi data.';

    public $childGender, $childGenderCategories, $childGenderValues, $childGenderTotal;
    public $cr1ImunizationAge13_16, $cr1ImunizationAge13_16Categories, $cr1ImunizationAge13_16Values, $cr1ImunizationAge13_16Total;
    public $cr1ImunizationAge18_59, $cr1ImunizationAge18_59Categories, $cr1ImunizationAge18_59Values, $cr1ImunizationAge18_59Total;
    public $cr1ImunizationAge5_7, $cr1ImunizationAge5_7Categories, $cr1ImunizationAge5_7Values, $cr1ImunizationAge5_7Total;
    public $cr1ImunizationAge7_13, $cr1ImunizationAge7_13Categories, $cr1ImunizationAge7_13Values, $cr1ImunizationAge7_13Total;
    public $cr1ImunizationAge9_18, $cr1ImunizationAge9_18Categories, $cr1ImunizationAge9_18Values, $cr1ImunizationAge9_18Total;

    public $cr2ImunizationAge13_16, $cr2ImunizationAge13_16Categories, $cr2ImunizationAge13_16Values, $cr2ImunizationAge13_16Total;
    public $cr2ImunizationAge18_59, $cr2ImunizationAge18_59Categories, $cr2ImunizationAge18_59Values, $cr2ImunizationAge18_59Total;
    public $cr2ImunizationAge5_7, $cr2ImunizationAge5_7Categories, $cr2ImunizationAge5_7Values, $cr2ImunizationAge5_7Total;
    public $cr2ImunizationAge7_13, $cr2ImunizationAge7_13Categories, $cr2ImunizationAge7_13Values, $cr2ImunizationAge7_13Total;
    public $cr2ImunizationAge9_18, $cr2ImunizationAge9_18Categories, $cr2ImunizationAge9_18Values, $cr2ImunizationAge9_18Total;

    public $crBiasImunizationAge13_16, $crBiasImunizationAge13_16Categories, $crBiasImunizationAge13_16Values, $crBiasImunizationAge13_16Total;
    public $crBiasImunizationAge18_59, $crBiasImunizationAge18_59Categories, $crBiasImunizationAge18_59Values, $crBiasImunizationAge18_59Total;
    public $crBiasImunizationAge5_7, $crBiasImunizationAge5_7Categories, $crBiasImunizationAge5_7Values, $crBiasImunizationAge5_7Total;
    public $crBiasImunizationAge7_13, $crBiasImunizationAge7_13Categories, $crBiasImunizationAge7_13Values, $crBiasImunizationAge7_13Total;
    public $crBiasImunizationAge9_18, $crBiasImunizationAge9_18Categories, $crBiasImunizationAge9_18Values, $crBiasImunizationAge9_18Total;

    public $crTambahanImunizationAge13_16, $crTambahanImunizationAge13_16Categories, $crTambahanImunizationAge13_16Values, $crTambahanImunizationAge13_16Total;
    public $crTambahanImunizationAge18_59, $crTambahanImunizationAge18_59Categories, $crTambahanImunizationAge18_59Values, $crTambahanImunizationAge18_59Total;
    public $crTambahanImunizationAge5_7, $crTambahanImunizationAge5_7Categories, $crTambahanImunizationAge5_7Values, $crTambahanImunizationAge5_7Total;
    public $crTambahanImunizationAge7_13, $crTambahanImunizationAge7_13Categories, $crTambahanImunizationAge7_13Values, $crTambahanImunizationAge7_13Total;
    public $crTambahanImunizationAge9_18, $crTambahanImunizationAge9_18Categories, $crTambahanImunizationAge9_18Values, $crTambahanImunizationAge9_18Total;
    
    public $immunizedInfo, $immunizedInfoCategories, $immunizedInfoValues, $immunizedInfoTotal;
    public $notImmunizedReason, $notImmunizedReasonCategories, $notImmunizedReasonValues, $notImmunizedReasonTotal;
    public $fever14Days, $fever14DaysCategories, $fever14DaysValues, $fever14DaysTotal;
    public $immunizedParentPermission, $immunizedParentPermissionCategories, $immunizedParentPermissionValues, $immunizedParentPermissionTotal;
    
    public $graphic_4;

    public $reference_fasyankes;

    public $kode_fasyankes;
    public $year;

    public $luas_wilayah;
    
    public function childGenderData()
    {
        /* childGender */
        $this->childGender = Form2Answer::selectRaw('gender, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->groupBy('year', 'kode_fasyankes', 'gender')
            ->pluck('total', 'gender');

        $this->childGenderCategories = $this->childGender->keys()->map(function ($key) {
            return $key == 'l' ? 'Laki-Laki' : 'Perempuan';
        })->toArray();

        $this->childGenderTotal = $this->childGender->sum();


        $this->childGenderValues = $this->childGender
            ->values()
            ->map(function ($key) { return round($key/$this->childGenderTotal*100); })
            ->toArray();
    }

    public function cr1Data()
    {
        /* cr1ImunizationAge13_16 */
        $this->cr1ImunizationAge13_16 = \DB::table('view_sck_ori')->selectRaw('q1, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '5')
            ->groupBy('year', 'kode_fasyankes', 'q1')
            ->pluck('total', 'q1');

        $this->cr1ImunizationAge13_16Categories = $this->cr1ImunizationAge13_16->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->cr1ImunizationAge13_16Total = $this->cr1ImunizationAge13_16->sum();


        $this->cr1ImunizationAge13_16Values = $this->cr1ImunizationAge13_16
            ->values()
            ->map(function ($key) { return round($key/$this->cr1ImunizationAge13_16Total*100); })
            ->toArray();

        /* cr1ImunizationAge18_59 */
        $this->cr1ImunizationAge18_59 = \DB::table('view_sck_ori')->selectRaw('q1, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '2')
            ->groupBy('year', 'kode_fasyankes', 'q1')
            ->pluck('total', 'q1');

        $this->cr1ImunizationAge18_59Categories = $this->cr1ImunizationAge18_59->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->cr1ImunizationAge18_59Total = $this->cr1ImunizationAge18_59->sum();


        $this->cr1ImunizationAge18_59Values = $this->cr1ImunizationAge18_59
            ->values()
            ->map(function ($key) { return round($key/$this->cr1ImunizationAge18_59Total*100); })
            ->toArray();

        /* cr1ImunizationAge5_7 */
        $this->cr1ImunizationAge5_7 = \DB::table('view_sck_ori')->selectRaw('q1, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '3')
            ->groupBy('year', 'kode_fasyankes', 'q1')
            ->pluck('total', 'q1');

        $this->cr1ImunizationAge5_7Categories = $this->cr1ImunizationAge5_7->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->cr1ImunizationAge5_7Total = $this->cr1ImunizationAge5_7->sum();


        $this->cr1ImunizationAge5_7Values = $this->cr1ImunizationAge5_7
            ->values()
            ->map(function ($key) { return round($key/$this->cr1ImunizationAge5_7Total*100); })
            ->toArray();

        /* cr1ImunizationAge7_13 */
        $this->cr1ImunizationAge7_13 = \DB::table('view_sck_ori')->selectRaw('q1, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '4')
            ->groupBy('year', 'kode_fasyankes', 'q1')
            ->pluck('total', 'q1');

        $this->cr1ImunizationAge7_13Categories = $this->cr1ImunizationAge7_13->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->cr1ImunizationAge7_13Total = $this->cr1ImunizationAge7_13->sum();


        $this->cr1ImunizationAge7_13Values = $this->cr1ImunizationAge7_13
            ->values()
            ->map(function ($key) { return round($key/$this->cr1ImunizationAge7_13Total*100); })
            ->toArray();

        /* cr1ImunizationAge9_18 */
        $this->cr1ImunizationAge9_18 = \DB::table('view_sck_ori')->selectRaw('q1, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '4')
            ->groupBy('year', 'kode_fasyankes', 'q1')
            ->pluck('total', 'q1');

        $this->cr1ImunizationAge9_18Categories = $this->cr1ImunizationAge9_18->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->cr1ImunizationAge9_18Total = $this->cr1ImunizationAge9_18->sum();


        $this->cr1ImunizationAge9_18Values = $this->cr1ImunizationAge9_18
            ->values()
            ->map(function ($key) { return round($key/$this->cr1ImunizationAge9_18Total*100); })
            ->toArray();
    }

    public function cr2Data()
    {
        /* cr2ImunizationAge13_16 */
        $this->cr2ImunizationAge13_16 = \DB::table('view_sck_ori')->selectRaw('q2, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '5')
            ->groupBy('year', 'kode_fasyankes', 'q2')
            ->pluck('total', 'q2');

        $this->cr2ImunizationAge13_16Categories = $this->cr2ImunizationAge13_16->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->cr2ImunizationAge13_16Total = $this->cr2ImunizationAge13_16->sum();


        $this->cr2ImunizationAge13_16Values = $this->cr2ImunizationAge13_16
            ->values()
            ->map(function ($key) { return round($key/$this->cr2ImunizationAge13_16Total*100); })
            ->toArray();

        /* cr2ImunizationAge18_59 */
        $this->cr2ImunizationAge18_59 = \DB::table('view_sck_ori')->selectRaw('q2, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '2')
            ->groupBy('year', 'kode_fasyankes', 'q2')
            ->pluck('total', 'q2');

        $this->cr2ImunizationAge18_59Categories = $this->cr2ImunizationAge18_59->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->cr2ImunizationAge18_59Total = $this->cr2ImunizationAge18_59->sum();


        $this->cr2ImunizationAge18_59Values = $this->cr2ImunizationAge18_59
            ->values()
            ->map(function ($key) { return round($key/$this->cr2ImunizationAge18_59Total*100); })
            ->toArray();

        /* cr2ImunizationAge5_7 */
        $this->cr2ImunizationAge5_7 = \DB::table('view_sck_ori')->selectRaw('q2, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '3')
            ->groupBy('year', 'kode_fasyankes', 'q2')
            ->pluck('total', 'q2');

        $this->cr2ImunizationAge5_7Categories = $this->cr2ImunizationAge5_7->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->cr2ImunizationAge5_7Total = $this->cr2ImunizationAge5_7->sum();


        $this->cr2ImunizationAge5_7Values = $this->cr2ImunizationAge5_7
            ->values()
            ->map(function ($key) { return round($key/$this->cr2ImunizationAge5_7Total*100); })
            ->toArray();

        /* cr2ImunizationAge7_13 */
        $this->cr2ImunizationAge7_13 = \DB::table('view_sck_ori')->selectRaw('q2, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '4')
            ->groupBy('year', 'kode_fasyankes', 'q2')
            ->pluck('total', 'q2');

        $this->cr2ImunizationAge7_13Categories = $this->cr2ImunizationAge7_13->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->cr2ImunizationAge7_13Total = $this->cr2ImunizationAge7_13->sum();


        $this->cr2ImunizationAge7_13Values = $this->cr2ImunizationAge7_13
            ->values()
            ->map(function ($key) { return round($key/$this->cr2ImunizationAge7_13Total*100); })
            ->toArray();

        /* cr2ImunizationAge9_18 */
        $this->cr2ImunizationAge9_18 = \DB::table('view_sck_ori')->selectRaw('q2, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '4')
            ->groupBy('year', 'kode_fasyankes', 'q2')
            ->pluck('total', 'q2');

        $this->cr2ImunizationAge9_18Categories = $this->cr2ImunizationAge9_18->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->cr2ImunizationAge9_18Total = $this->cr2ImunizationAge9_18->sum();


        $this->cr2ImunizationAge9_18Values = $this->cr2ImunizationAge9_18
            ->values()
            ->map(function ($key) { return round($key/$this->cr2ImunizationAge9_18Total*100); })
            ->toArray();
    }

    public function crBiasData()
    {
        /* crBiasImunizationAge13_16 */
        $this->crBiasImunizationAge13_16 = \DB::table('view_sck_ori')->selectRaw('q3, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '5')
            ->groupBy('year', 'kode_fasyankes', 'q3')
            ->pluck('total', 'q3');

        $this->crBiasImunizationAge13_16Categories = $this->crBiasImunizationAge13_16->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->crBiasImunizationAge13_16Total = $this->crBiasImunizationAge13_16->sum();


        $this->crBiasImunizationAge13_16Values = $this->crBiasImunizationAge13_16
            ->values()
            ->map(function ($key) { return round($key/$this->crBiasImunizationAge13_16Total*100); })
            ->toArray();

        /* crBiasImunizationAge18_59 */
        $this->crBiasImunizationAge18_59 = \DB::table('view_sck_ori')->selectRaw('q3, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '2')
            ->groupBy('year', 'kode_fasyankes', 'q3')
            ->pluck('total', 'q3');

        $this->crBiasImunizationAge18_59Categories = $this->crBiasImunizationAge18_59->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->crBiasImunizationAge18_59Total = $this->crBiasImunizationAge18_59->sum();


        $this->crBiasImunizationAge18_59Values = $this->crBiasImunizationAge18_59
            ->values()
            ->map(function ($key) { return round($key/$this->crBiasImunizationAge18_59Total*100); })
            ->toArray();

        /* crBiasImunizationAge5_7 */
        $this->crBiasImunizationAge5_7 = \DB::table('view_sck_ori')->selectRaw('q3, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '3')
            ->groupBy('year', 'kode_fasyankes', 'q3')
            ->pluck('total', 'q3');

        $this->crBiasImunizationAge5_7Categories = $this->crBiasImunizationAge5_7->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->crBiasImunizationAge5_7Total = $this->crBiasImunizationAge5_7->sum();


        $this->crBiasImunizationAge5_7Values = $this->crBiasImunizationAge5_7
            ->values()
            ->map(function ($key) { return round($key/$this->crBiasImunizationAge5_7Total*100); })
            ->toArray();

        /* crBiasImunizationAge7_13 */
        $this->crBiasImunizationAge7_13 = \DB::table('view_sck_ori')->selectRaw('q3, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '4')
            ->groupBy('year', 'kode_fasyankes', 'q3')
            ->pluck('total', 'q3');

        $this->crBiasImunizationAge7_13Categories = $this->crBiasImunizationAge7_13->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->crBiasImunizationAge7_13Total = $this->crBiasImunizationAge7_13->sum();


        $this->crBiasImunizationAge7_13Values = $this->crBiasImunizationAge7_13
            ->values()
            ->map(function ($key) { return round($key/$this->crBiasImunizationAge7_13Total*100); })
            ->toArray();

        /* crBiasImunizationAge9_18 */
        $this->crBiasImunizationAge9_18 = \DB::table('view_sck_ori')->selectRaw('q3, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '4')
            ->groupBy('year', 'kode_fasyankes', 'q3')
            ->pluck('total', 'q3');

        $this->crBiasImunizationAge9_18Categories = $this->crBiasImunizationAge9_18->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->crBiasImunizationAge9_18Total = $this->crBiasImunizationAge9_18->sum();


        $this->crBiasImunizationAge9_18Values = $this->crBiasImunizationAge9_18
            ->values()
            ->map(function ($key) { return round($key/$this->crBiasImunizationAge9_18Total*100); })
            ->toArray();
    }

    public function crTambahanData()
    {
        /* crTambahanImunizationAge13_16 */
        $this->crTambahanImunizationAge13_16 = \DB::table('view_sck_ori')->selectRaw('q4, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '5')
            ->groupBy('year', 'kode_fasyankes', 'q4')
            ->pluck('total', 'q4');

        $this->crTambahanImunizationAge13_16Categories = $this->crTambahanImunizationAge13_16->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->crTambahanImunizationAge13_16Total = $this->crTambahanImunizationAge13_16->sum();


        $this->crTambahanImunizationAge13_16Values = $this->crTambahanImunizationAge13_16
            ->values()
            ->map(function ($key) { return round($key/$this->crTambahanImunizationAge13_16Total*100); })
            ->toArray();

        /* crTambahanImunizationAge18_59 */
        $this->crTambahanImunizationAge18_59 = \DB::table('view_sck_ori')->selectRaw('q4, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '2')
            ->groupBy('year', 'kode_fasyankes', 'q4')
            ->pluck('total', 'q4');

        $this->crTambahanImunizationAge18_59Categories = $this->crTambahanImunizationAge18_59->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->crTambahanImunizationAge18_59Total = $this->crTambahanImunizationAge18_59->sum();


        $this->crTambahanImunizationAge18_59Values = $this->crTambahanImunizationAge18_59
            ->values()
            ->map(function ($key) { return round($key/$this->crTambahanImunizationAge18_59Total*100); })
            ->toArray();

        /* crTambahanImunizationAge5_7 */
        $this->crTambahanImunizationAge5_7 = \DB::table('view_sck_ori')->selectRaw('q4, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '3')
            ->groupBy('year', 'kode_fasyankes', 'q4')
            ->pluck('total', 'q4');

        $this->crTambahanImunizationAge5_7Categories = $this->crTambahanImunizationAge5_7->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->crTambahanImunizationAge5_7Total = $this->crTambahanImunizationAge5_7->sum();


        $this->crTambahanImunizationAge5_7Values = $this->crTambahanImunizationAge5_7
            ->values()
            ->map(function ($key) { return round($key/$this->crTambahanImunizationAge5_7Total*100); })
            ->toArray();

        /* crTambahanImunizationAge7_13 */
        $this->crTambahanImunizationAge7_13 = \DB::table('view_sck_ori')->selectRaw('q4, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '4')
            ->groupBy('year', 'kode_fasyankes', 'q4')
            ->pluck('total', 'q4');

        $this->crTambahanImunizationAge7_13Categories = $this->crTambahanImunizationAge7_13->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->crTambahanImunizationAge7_13Total = $this->crTambahanImunizationAge7_13->sum();


        $this->crTambahanImunizationAge7_13Values = $this->crTambahanImunizationAge7_13
            ->values()
            ->map(function ($key) { return round($key/$this->crTambahanImunizationAge7_13Total*100); })
            ->toArray();

        /* crTambahanImunizationAge9_18 */
        $this->crTambahanImunizationAge9_18 = \DB::table('view_sck_ori')->selectRaw('q4, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->where('age_group', '4')
            ->groupBy('year', 'kode_fasyankes', 'q4')
            ->pluck('total', 'q4');

        $this->crTambahanImunizationAge9_18Categories = $this->crTambahanImunizationAge9_18->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->crTambahanImunizationAge9_18Total = $this->crTambahanImunizationAge9_18->sum();


        $this->crTambahanImunizationAge9_18Values = $this->crTambahanImunizationAge9_18
            ->values()
            ->map(function ($key) { return round($key/$this->crTambahanImunizationAge9_18Total*100); })
            ->toArray();
    }

    public function immunizedInfo()
    {
        /* immunizedInfo */
        $this->immunizedInfo = Form2Answer::selectRaw('q7, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->groupBy('year', 'kode_fasyankes', 'q7')
            ->pluck('total', 'q7');

        $this->immunizedInfoCategories = $this->immunizedInfo->keys()->map(function ($key) {
            return explode(' ', $key);
        })->toArray();

        $this->immunizedInfoTotal = $this->immunizedInfo->sum();


        $this->immunizedInfoValues = $this->immunizedInfo
            ->values()
            ->map(function ($key) { return round($key/$this->immunizedInfoTotal*100); })
            ->toArray();
    }

    public function notImmunizedReason()
    {
        /* notImmunizedReason */
        $this->notImmunizedReason = Form2Answer::selectRaw('q5, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->groupBy('year', 'kode_fasyankes', 'q5')
            ->pluck('total', 'q5');

        $this->notImmunizedReasonCategories = $this->notImmunizedReason->keys()->map(function ($key) {
            return explode(' ', $key);
        })->toArray();

        $this->notImmunizedReasonTotal = $this->notImmunizedReason->sum();


        $this->notImmunizedReasonValues = $this->notImmunizedReason
            ->values()
            ->map(function ($key) { return round($key/$this->notImmunizedReasonTotal*100); })
            ->toArray();
    }

    public function fever14Days()
    {
        /* fever14Days */
        $this->fever14Days = Form2Answer::selectRaw('q8, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->groupBy('year', 'kode_fasyankes', 'q8')
            ->pluck('total', 'q8');

        $this->fever14DaysCategories = $this->fever14Days->keys()->map(function ($key) {
            return $key == 'y' ? 'Ya' : 'Tidak';
        })->toArray();

        $this->fever14DaysTotal = $this->fever14Days->sum();


        $this->fever14DaysValues = $this->fever14Days
            ->values()
            ->map(function ($key) { return round($key/$this->fever14DaysTotal*100); })
            ->toArray();
    }

    public function immunizedParentPermission()
    {
        /* immunizedParentPermission */
        $this->immunizedParentPermission = Form2Answer::selectRaw('q6, COUNT(*) as total')
            ->where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->groupBy('year', 'kode_fasyankes', 'q6')
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

    public function ChangeKodeFasyankes()
    {

        /* childGender */
        $this->childGenderData();
        /* CR1 */
        $this->cr1Data();
        /* CR2 */
        $this->cr2Data();
        /* CR BIAS */
        $this->crBiasData();
        /* CR TAMBAHAN */
        $this->crTambahanData();

        

        /* immunizedInfo */
        $this->immunizedInfo();
        /* notImmunizedReason */
        $this->notImmunizedReason();
        /* fever14Days */
        $this->fever14Days();
        /* immunizedParentPermission */
        $this->immunizedParentPermission();



        /* Grafik 4 */
        $this->graphic_4 = ViewSummarySckOri::where('kode_fasyankes', $this->kode_fasyankes)->where('year', $this->year)->get();

        /* Luas Wilayah */
        $this->luas_wilayah = Form1Answer::where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->get()
            ->toArray();

        $this->dispatch('changeKodeFasyankes');

    }

    public function ChangeYear()
    {

        /* childGender */
        $this->childGenderData();
        /* CR1 */
        $this->cr1Data();
        /* CR2 */
        $this->cr2Data();
        /* CR BIAS */
        $this->crBiasData();
        /* CR TAMBAHAN */
        $this->crTambahanData();

        

        /* immunizedInfo */
        $this->immunizedInfo();
        /* notImmunizedReason */
        $this->notImmunizedReason();
        /* fever14Days */
        $this->fever14Days();
        /* immunizedParentPermission */
        $this->immunizedParentPermission();



        /* Grafik 4 */
        $this->graphic_4 = ViewSummarySckOri::where('kode_fasyankes', $this->kode_fasyankes)->where('year', $this->year)->get();

        /* Luas Wilayah */
        $this->luas_wilayah = Form1Answer::where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->get()
            ->toArray();



        $this->dispatch('changeYear');

    }

    public function mount()
    {

        $this->reference_fasyankes = Fasyankes::select('kode_fasyankes', 'name')->pluck('name', 'kode_fasyankes');


        $this->kode_fasyankes = auth()->user()->kode_fasyankes ?? '32760200001';
        $this->year = now()->format('Y');

        /* childGender */
        $this->childGenderData();
        /* CR1 */
        $this->cr1Data();
        /* CR2 */
        $this->cr2Data();
        /* CR BIAS */
        $this->crBiasData();
        /* CR TAMBAHAN */
        $this->crTambahanData();

        

        /* immunizedInfo */
        $this->immunizedInfo();
        /* notImmunizedReason */
        $this->notImmunizedReason();
        /* fever14Days */
        $this->fever14Days();
        /* immunizedParentPermission */
        $this->immunizedParentPermission();



        /* Grafik 4 */
        $this->graphic_4 = ViewSummarySckOri::where('kode_fasyankes', $this->kode_fasyankes)->where('year', $this->year)->get();

        /* Luas Wilayah */
        $this->luas_wilayah = Form1Answer::where('kode_fasyankes', $this->kode_fasyankes)
            ->where('year', $this->year)
            ->get()
            ->toArray();
        

    }

}
