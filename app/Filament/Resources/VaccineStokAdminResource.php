<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VaccineStokAdminResource\Pages;
use App\Models\Form3Answer;
use App\Models\Fasyankes;
use App\Models\Vaccine;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Enums\FiltersLayout;

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
        return $form->schema([]);
    }

    public static function getTotalKebutuhanVaksin(string $kodeFasyankes): int
    {
        $form3Answers = Form3Answer::where('kode_fasyankes', $kodeFasyankes)
            ->whereNotNull('village_target')
            ->whereNotNull('coverage_target')
            ->get();

        $totalDosis = 0;

        foreach ($form3Answers as $answer) {
            $villageTarget = floatval($answer->village_target);
            $coverage = floatval($answer->coverage_target);

            if ($villageTarget && $coverage) {
                $totalDosis += $villageTarget * $coverage / 100;
            }
        }

        return (int) round($totalDosis);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->groupBy('kode_fasyankes')->with('fasyankes');
                if (auth()->user()->hasRole('Puskesmas')) {
                    $query->where('kode_fasyankes', auth()->user()->kode_fasyankes);
                }
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
                            "(SELECT COALESCE(SUM(
                                CASE 
                                    WHEN v.category = 'penambahan' THEN v.amount
                                    WHEN v.category = 'pengurangan' THEN -v.amount
                                    ELSE 0
                                END
                            ), 0)
                            FROM vaccines v
                            WHERE v.kode_fasyankes = vaccines.kode_fasyankes
                            AND YEAR(v.date) = ?) {$direction}",
                            [$year]
                        );
                    })
                    ->getStateUsing(function ($record) {
                        return static::getModel()::getTotalStok($record->kode_fasyankes, now()->format('Y'));
                    })
                    ->label('Stok Vaksin'),

                Tables\Columns\TextColumn::make('status')
                    ->getStateUsing(function ($record) {
                        $kodeFasyankes = $record->kode_fasyankes;
                        $totalKebutuhan = self::getTotalKebutuhanVaksin($kodeFasyankes);
                        $stok = static::getModel()::getTotalStok($kodeFasyankes, now()->format('Y'));

                        return $stok >= $totalKebutuhan ? 'CUKUP' : 'TIDAK CUKUP';
                    })
                    ->badge()
                    ->color(fn ($state) => $state === 'CUKUP' ? 'success' : 'danger')
                    ->label('Status')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall),
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
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVaccineStokAdmins::route('/'),
        ];
    }
}
