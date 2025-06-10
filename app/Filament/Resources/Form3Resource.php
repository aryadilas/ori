<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Form3Resource\Pages;
use App\Filament\Resources\Form3Resource\RelationManagers;
use App\Models\Form3Answer;
use App\Models\Fasyankes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Filament\Tables\Columns\Summarizers\Sum;

class Form3Resource extends Resource
{
    protected static ?string $model = Form3Answer::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Kelompok Usia';

    protected static ?string $slug = 'kelompok-usia';

    protected static ?string $label = 'Kelompok Usia';

    protected static ?string $pluralModelLabel = 'Kelompok Usia';

    protected static ?string $navigationGroup = 'INPUT KAJIAN EPIDEMIOLOGI';

    protected static ?int $navigationSort = 4;

    public static function getEloquentQuery(): Builder
    {
        $subquery = \DB::table('form3_answers')
            ->selectRaw('
                kode_fasyankes,
                year,
                SUM(population) AS total_population,
                SUM(population * ((suspect / population) * 100)) / SUM(population) AS ar_average
            ')
            ->groupBy('kode_fasyankes', 'year');

        if (auth()->user()->hasRole('Puskesmas')) {
            return parent::getEloquentQuery()
                ->selectRaw('
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
                ->leftJoin('view_summary_sck_ori', function ($join) {
                    $join->on('form3_answers.kode_fasyankes', '=', 'view_summary_sck_ori.kode_fasyankes')
                        ->on('form3_answers.year', '=', 'view_summary_sck_ori.year')
                        ->on('form3_answers.age_group', '=', 'view_summary_sck_ori.usia');
                })
                ->leftJoinSub($subquery, 'subquery', function ($join) {
                    $join->on('form3_answers.kode_fasyankes', '=', 'subquery.kode_fasyankes')
                        ->on('form3_answers.year', '=', 'subquery.year');
                })
                ->where('form3_answers.kode_fasyankes', auth()->user()->kode_fasyankes);
        } else {
            return parent::getEloquentQuery()
                ->selectRaw('
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
                ->leftJoin('view_summary_sck_ori', function ($join) {
                    $join->on('form3_answers.kode_fasyankes', '=', 'view_summary_sck_ori.kode_fasyankes')
                        ->on('form3_answers.year', '=', 'view_summary_sck_ori.year')
                        ->on('form3_answers.age_group', '=', 'view_summary_sck_ori.usia');
                })
                ->leftJoinSub($subquery, 'subquery', function ($join) {
                    $join->on('form3_answers.kode_fasyankes', '=', 'subquery.kode_fasyankes')
                        ->on('form3_answers.year', '=', 'subquery.year');
                });
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('year')
                    ->label('Tahun')
                    ->live()
                    ->options(function () {
                        $currentYear = now()->year;
                        $startYear = $currentYear - 2;
                        $endYear = $currentYear + 2;

                        $options = [];
                        for ($i = $startYear; $i <= $endYear; $i++) { 
                            $dataCheck = static::getModel()::where('year', $i)->where('kode_fasyankes', auth()->user()->kode_fasyankes)->exists();
                            if(!$dataCheck){
                                $options[$i] = $i;
                            }
                        }
                        return $options;
                    })
                    ->inlineLabel()
                    ->required(),
                Forms\Components\TextInput::make('village_name')
                    ->label('Desa/Kelurahan')
                    ->inlineLabel()
                    ->required(),

                Forms\Components\Section::make('Usia 9 - < 18 Bulan')
                    ->description('Usia 9 sampai kurang dari 18 bulan')
                    ->visible(fn ($get) => $get('year'))
                    ->schema([
                        Forms\Components\TextInput::make('suspect_9to18month')
                            ->label('Jumlah suspek atau kasus')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\TextInput::make('village_target_9to18month')
                            ->label('Sasaran Kelurahan')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\TextInput::make('population_9to18month')
                            ->label('Sasaran Kecamatan')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                    ]),
                Forms\Components\Section::make('Usia 18 - 59 Bulan')
                    ->description('Usia 18 sampai 59 Bulan')
                    ->visible(fn ($get) => $get('year'))
                    ->schema([
                        Forms\Components\TextInput::make('suspect_18to59month')
                            ->label('Jumlah suspek atau kasus')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\TextInput::make('village_target_18to59month')
                            ->label('Sasaran Kelurahan')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\TextInput::make('population_18to59month')
                            ->label('Sasaran Kecamatan')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                    ]),
                Forms\Components\Section::make('Usia 5 - < 7 Tahun')
                    ->description('Usia 5 sampai kurang dari 7 tahun')
                    ->visible(fn ($get) => $get('year'))
                    ->schema([
                        Forms\Components\TextInput::make('suspect_5to7year')
                            ->label('Jumlah suspek atau kasus')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\TextInput::make('village_target_5to7year')
                            ->label('Sasaran Kelurahan')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\TextInput::make('population_5to7year')
                            ->label('Sasaran Kecamatan')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                    ]),
                Forms\Components\Section::make('Usia 7 - < 13 Tahun')
                    ->description('Usia 7 sampai kurang dari 13')
                    ->visible(fn ($get) => $get('year'))
                    ->schema([
                        Forms\Components\TextInput::make('suspect_7to13year')
                            ->label('Jumlah suspek atau kasus')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\TextInput::make('village_target_7to13year')
                            ->label('Sasaran Kelurahan')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\TextInput::make('population_7to13year')
                            ->label('Sasaran Kecamatan')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                    ]),
                Forms\Components\Section::make('Usia 13 - < 16 Tahun')
                    ->description('Usia 13 sampai kurang dari 16 tahun')
                    ->visible(fn ($get) => $get('year'))
                    ->schema([
                        Forms\Components\TextInput::make('suspect_13to16year')
                            ->label('Jumlah suspek atau kasus')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\TextInput::make('village_target_13to16year')
                            ->label('Sasaran Kelurahan')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\TextInput::make('population_13to16year')
                            ->label('Sasaran Kecamatan')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                    ]),
                Forms\Components\Section::make('Usia ≥ 16 tahun')
                    ->description('Usia lebih dari sama dengan 16 tahun')
                    ->visible(fn ($get) => $get('year'))
                    ->schema([
                        Forms\Components\TextInput::make('suspect_more16year')
                            ->label('Jumlah suspek atau kasus')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\TextInput::make('village_target_more16year')
                            ->label('Sasaran Kelurahan')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\TextInput::make('population_more16year')
                            ->label('Sasaran Kecamatan')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->header(function () {
                if (auth()->user()->hasRole('Puskesmas')) {
                    return view('filament.header.custom-header', ['file_path' => '/template/attack_rate.xlsx']);
                }
            })
            ->columns([
                Tables\Columns\TextColumn::make("fasyankes.name")
                    ->placeholder('-')
                    ->hidden(auth()->user()->hasRole('Puskesmas'))
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Puskesmas"),
                Tables\Columns\TextColumn::make("year")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Tahun"),
                Tables\Columns\TextColumn::make("village_name")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Desa/Kelurahan"),
                Tables\Columns\TextColumn::make("age_group")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Kelompok Usia"),
                Tables\Columns\TextColumn::make("suspect")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Jumlah suspect atau kasus"),
                Tables\Columns\TextColumn::make("suspect")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->summarize(Sum::make()->label(''))
                    ->label("Jumlah suspect atau kasus"),
                Tables\Columns\TextColumn::make("village_target")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Sasaran Kelurahan"),
                Tables\Columns\TextColumn::make("population")
                    ->placeholder('-')
                    ->summarize(Sum::make()->label(''))
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Sasaran Kecamatan"),
                Tables\Columns\TextColumn::make("attackRate")
                    ->placeholder('-')
                    ->summarize(
                        Summarizer::make()
                            ->label('Rata Rata')
                            ->using(fn ($query) => $query->value('ar_average'))
                    )
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Attack Rate (AR) Kecamatan"),
                Tables\Columns\TextColumn::make("cr1_scope")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("SCK:Cakupan Campak Rubela 1"),
                Tables\Columns\TextColumn::make("cr2_scope")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("SCK:Cakupan Campak Rubela 2"),
                Tables\Columns\TextColumn::make("crBias_scope")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("SCK:Cakupan Campak Rubela Bias"),
                Tables\Columns\TextColumn::make("average")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Rata - Rata Cakupan SCK"),
                Tables\Columns\TextColumn::make("sasaran_ori")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Sasaran ORI"),
            ])
            ->filters([
                SelectFilter::make('year')
                    ->label('Tahun')
                    ->options(function () {
                        $yearExists = static::getModel()::select('year')
                        ->when(auth()->user()->kode_fasyankes, function ($query) {
                            return $query->where('form3_answers.kode_fasyankes', auth()->user()->kode_fasyankes);
                        })
                        ->distinct()
                        ->get()
                        ->pluck('year');
                        
                        $options = [];

                        foreach ($yearExists as $value) {
                            $options[$value] = $value;
                        }

                        if (!$yearExists) {
                            $options[now()->year] = now()->year;
                            return $options;
                        }

                        return $options;
                    })
                    ->default(now()->year)
                    ->selectablePlaceholder(false)
                    ->attribute('form3_answers.year'),
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
                    ->attribute('form3_answers.kode_fasyankes')
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->visible(auth()->user()->hasRole('Puskesmas'))
                    ->form([
                        Forms\Components\TextInput::make('village_name')
                            ->label('Desa/Kelurahan')
                            ->inlineLabel(),

                        Forms\Components\Section::make('Usia 9 - < 18 Bulan')
                            ->description('Usia 9 sampai kurang dari 18 bulan')
                            ->visible(fn ($record) => $record->age_group === '9 - <18 bulan')
                            ->schema([
                                Forms\Components\TextInput::make('suspect')
                                    ->label('Jumlah suspek atau kasus')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                                Forms\Components\TextInput::make('village_target')
                                    ->label('Sasaran Kelurahan')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                                Forms\Components\TextInput::make('population')
                                    ->label('Sasaran Kecamatan')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                            ]),
                        Forms\Components\Section::make('Usia 18 - 59 Bulan')
                            ->description('Usia 18 sampai 59 Bulan')
                            ->visible(fn ($record) => $record->age_group === '18 - 59 bulan')
                            ->schema([
                                Forms\Components\TextInput::make('suspect')
                                    ->label('Jumlah suspek atau kasus')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                                Forms\Components\TextInput::make('village_target')
                                    ->label('Sasaran Kelurahan')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                                Forms\Components\TextInput::make('population')
                                    ->label('Sasaran Kecamatan')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                            ]),
                        Forms\Components\Section::make('Usia 5 - < 7 Tahun')
                            ->description('Usia 5 sampai kurang dari 7 tahun')
                            ->visible(fn ($record) => $record->age_group === '5 - <7 tahun')
                            ->schema([
                                Forms\Components\TextInput::make('suspect')
                                    ->label('Jumlah suspek atau kasus')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                                Forms\Components\TextInput::make('village_target')
                                    ->label('Sasaran Kelurahan')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                                Forms\Components\TextInput::make('population')
                                    ->label('Sasaran Kecamatan')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                            ]),
                        Forms\Components\Section::make('Usia 7 - < 13 Tahun')
                            ->description('Usia 7 sampai kurang dari 13')
                            ->visible(fn ($record) => $record->age_group === '7 - <13 tahun')
                            ->schema([
                                Forms\Components\TextInput::make('suspect')
                                    ->label('Jumlah suspek atau kasus')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                                Forms\Components\TextInput::make('village_target')
                                    ->label('Sasaran Kelurahan')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                                Forms\Components\TextInput::make('population')
                                    ->label('Sasaran Kecamatan')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                            ]),
                        Forms\Components\Section::make('Usia 13 - < 16 Tahun')
                            ->description('Usia 13 sampai kurang dari 16 tahun')
                            ->visible(fn ($record) => $record->age_group === '13 - <16 tahun')
                            ->schema([
                                Forms\Components\TextInput::make('suspect')
                                    ->label('Jumlah suspek atau kasus')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                                Forms\Components\TextInput::make('village_target')
                                    ->label('Sasaran Kelurahan')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                                Forms\Components\TextInput::make('population')
                                    ->label('Sasaran Kecamatan')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                            ]),
                        Forms\Components\Section::make('Usia ≥ 16 tahun')
                            ->description('Usia lebih dari sama dengan 16 tahun')
                            ->visible(fn ($record) => $record->age_group === '≥ 16 tahun')
                            ->schema([
                                Forms\Components\TextInput::make('suspect')
                                    ->label('Jumlah suspek atau kasus')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                                Forms\Components\TextInput::make('village_target')
                                    ->label('Sasaran Kelurahan')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                                Forms\Components\TextInput::make('population')
                                    ->label('Sasaran Kecamatan')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                            ]),
                    ])
                    ->mountUsing(function ($form, $record) {
                        $form->fill($record->attributesToArray());
                    })
                    ->action(function ($data, $record) {
                        $record->update($data);

                        Notification::make()
                            ->success()
                            ->title('Berhasil Disimpan')
                            ->send();
                    }),
                Tables\Actions\Action::make('delete')
                    ->visible(auth()->user()->hasRole('Puskesmas'))
                    ->action(function ($record) {
                        $record->delete();

                        Notification::make()
                            ->success()
                            ->title('Data Berhasil Dihapus')
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->color('danger'),
            ])
            ->emptyStateHeading('Data Kosong')
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageForm3s::route('/'),
        ];
    }
}

