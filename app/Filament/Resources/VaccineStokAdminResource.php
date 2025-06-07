<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VaccineStokAdminResource\Pages;
use App\Filament\Resources\VaccineStokAdminResource\RelationManagers;
use App\Models\Vaccine;
use App\Models\Form3Answer;
use App\Models\Fasyankes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;

class VaccineStokAdminResource extends Resource
{
    protected static ?string $model = Vaccine::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Stok Vaksin';

    protected static ?string $slug = 'vaksin-stok';

    protected static ?string $label = 'Stok Vaksin';

    protected static ?string $pluralModelLabel = 'Stok Vaksin';

    protected static ?string $navigationGroup = 'VAKSIN';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole(['Dinkes', 'Kemkes', 'Puskesmas']); 
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function getTotalVaccineTarget()
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


        $form3Answers->get();
        $total = 0;

        foreach($form3Answers as $form3Answer)
        {

            $subtotal = isset($form3Answer->coverage_target) && isset($form3Answer->village_target)
                                ? (int) $form3Answer->village_target * (int) $form3Answer->coverage_target / 100
                                : 0;
            $total += $subtotal > 0 ? $subtotal : 0;

        }

        return $total;

    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) use ($table) {

                $query->groupBy('kode_fasyankes')->with('fasyankes');
                if (auth()->user()->hasRole('Puskesmas')) {
                    $query->where('kode_fasyankes', auth()->user()->kode_fasyankes);
                }
                return $query;

            })
            ->columns([
                Tables\Columns\TextColumn::make('fasyankes.name')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->sortable()
                    ->label('Fasyankes'),
                Tables\Columns\TextColumn::make('stock')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->sortable(query: function ($query, $direction) {
                        $year = now()->format('Y');
                
                        $query->orderByRaw(
                            "(SELECT 
                                COALESCE(SUM(
                                    CASE 
                                        WHEN v.category = 'penambahan' THEN v.amount
                                        WHEN v.category = 'pengurangan' THEN -v.amount
                                        ELSE 0
                                    END
                                ), 0)
                             FROM vaccines v
                             WHERE v.kode_fasyankes = vaccines.kode_fasyankes
                             AND YEAR(v.date) = ?
                            ) {$direction}", 
                            [$year]
                        );
                    })
                    ->getStateUsing(function ($record) {
                        return static::getModel()::getTotalStok($record->kode_fasyankes, now()->format('Y'));
                    })
                    ->label('Stok Vaksin'),
                Tables\Columns\TextColumn::make('status')
                    ->getStateUsing(function ($record, $livewire) {
                        $totalVaccineTarget = self::getTotalVaccineTarget();
                        if ($totalVaccineTarget < $record->stock) {
                            return 'TIDAK CUKUP';
                        } 

                        return 'CUKUP';
                    })
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)


            ])
            ->defaultSort('date', 'desc')
            ->paginated([30, 60, 100, 'all'])
            ->defaultPaginationPageOption(60)
            ->emptyStateHeading('Data Kosong')
            ->filters([

                    SelectFilter::make('fasyankes')
                    ->label('Fasyankes')
                    ->hidden(auth()->user()->hasRole('Puskesmas'))
                    ->options(function () {

                        $fasyankesExists = Fasyankes::select('name', 'kode_fasyankes')
                            ->distinct()
                            ->get()
                            ->pluck('name', 'kode_fasyankes');
                        
                        return collect(['' => 'SEMUA'])->union($fasyankesExists);

                    })
                    ->default('')
                    ->selectablePlaceholder(false)
                    ->attribute('kode_fasyankes')

            ], layout: FiltersLayout::AboveContent)
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVaccineStokAdmins::route('/'),
        ];
    }
}
