<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Form3Answer;

class VaccineTarget extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-eye-dropper';

    protected static string $view = 'filament.pages.vaccine-target';

    protected static ?string $navigationLabel = 'Kebutuhan Vaksin';

    protected static ?string $slug = 'kebutuhan-vaksin';

    protected static ?string $label = 'Kebutuhan Vaksin';

    protected static ?string $pluralModelLabel = 'Kebutuhan Vaksin';

    protected static ?string $navigationGroup = 'VAKSIN';

    
    protected static ?string $title = 'Kebutuhan Vaksin';

    protected ?string $heading = 'Kebutuhan Vaksin';

    protected ?string $subheading = 'Halaman untuk mengolah data kebutuhan vaksin';

    public $form3Answers;

    public $vaccine_target;
    public $coverage_target;

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole(['Super Admin', 'Dinkes', 'Puskesmas']); 
    }

    public function mount()
    {
        
        $subquery = \DB::table('form3_answers')
            ->selectRaw('
                kode_fasyankes,
                year,
                SUM(population) AS total_population,
                SUM(population * ((suspect / population) * 100)) / SUM(population) AS ar_average
            ')
            ->groupBy('kode_fasyankes', 'year');

        $form3Answers = Form3Answer::selectRaw('
                    form3_answers.*, 
                    view_summary_sck_ori.cr1_scope, 
                    view_summary_sck_ori.cr2_scope, 
                    view_summary_sck_ori.crBias_scope,
                    subquery.ar_average,
                    (form3_answers.suspect/form3_answers.population)*100 AS ar,
                    ROUND((
                        COALESCE(cr1_scope, 0) + COALESCE(cr2_scope, 0) + COALESCE(crBias_scope, 0)
                    ) / NULLIF(
                        (CASE WHEN cr1_scope IS NOT NULL THEN 1 ELSE 0 END) +
                        (CASE WHEN cr2_scope IS NOT NULL THEN 1 ELSE 0 END) +
                        (CASE WHEN crBias_scope IS NOT NULL THEN 1 ELSE 0 END), 0
                    ), 1) AS average,
                    CASE
                        WHEN (form3_answers.suspect/form3_answers.population)*100 >= subquery.ar_average THEN "YA"
                        WHEN (form3_answers.suspect/form3_answers.population)*100 < subquery.ar_average AND 
                        ROUND((
                            COALESCE(cr1_scope, 0) + COALESCE(cr2_scope, 0) + COALESCE(crBias_scope, 0)
                        ) / NULLIF(
                            (CASE WHEN cr1_scope IS NOT NULL THEN 1 ELSE 0 END) +
                            (CASE WHEN cr2_scope IS NOT NULL THEN 1 ELSE 0 END) +
                            (CASE WHEN crBias_scope IS NOT NULL THEN 1 ELSE 0 END), 0
                        ), 1) < 80 THEN "YA"
                        ELSE "TIDAK"
                    END AS sasaran_ori
                ')
                ->with('fasyankes')
                ->leftJoin('view_summary_sck_ori', function ($join) {
                    $join->on('form3_answers.kode_fasyankes', '=', 'view_summary_sck_ori.kode_fasyankes')
                        ->on('form3_answers.year', '=', 'view_summary_sck_ori.year')
                        ->on('form3_answers.age_group', '=', 'view_summary_sck_ori.usia');
                })
                ->leftJoinSub($subquery, 'subquery', function ($join) {
                    $join->on('form3_answers.kode_fasyankes', '=', 'subquery.kode_fasyankes')
                        ->on('form3_answers.year', '=', 'subquery.year');
                })
                ->havingRaw('sasaran_ori = "YA"');



        if (auth()->user()->hasRole('Puskesmas')) {
            $form3Answers->where('form3_answers.kode_fasyankes', auth()->user()->kode_fasyankes);
        }


        $this->form3Answers = $form3Answers->orderBy('kode_fasyankes')->get();
        $this->vaccine_target = $this->form3Answers->mapWithKeys(fn ($answer) => [
                $answer->id => $answer->vaccine_target,
            ])
            ->toArray();  
        $this->coverage_target = $this->form3Answers->mapWithKeys(fn ($answer) => [
                $answer->id => $answer->coverage_target,
            ])
            ->toArray();  

            // dd($this->coverage_target);

    }

    public function updateVaccineTarget($form3Answer_id, $vaccine_target)
    {

        $this->form3Answers->where('id', $form3Answer_id)->first()->update([
            'vaccine_target' => $vaccine_target
        ]);

    }

    public function updateCoverageTarget($form3Answer_id, $coverage_target)
    {

        $this->form3Answers->where('id', $form3Answer_id)->first()->update([
            'coverage_target' => $coverage_target
        ]);

    }

}
