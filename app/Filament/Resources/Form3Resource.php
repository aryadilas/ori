<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Form3Resource\Pages;
use App\Filament\Resources\Form3Resource\RelationManagers;
use App\Models\Form3Answer;
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

class Form3Resource extends Resource
{
    protected static ?string $model = Form3Answer::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Kelompok Usia';

    protected static ?string $slug = 'kelompok-usia';

    protected static ?string $label = 'Kelompok Usia';

    protected static ?string $pluralModelLabel = 'Kelompok Usia';

    protected static ?string $navigationGroup = 'DATA';

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole('Puskesmas')) {
            return parent::getEloquentQuery()->where('kode_fasyankes', auth()->user()->kode_fasyankes);
        } else {
            return parent::getEloquentQuery();
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 'kode_fasyankes',
                // 'year',
                // 'age_group',
                // 'suspect',
                // 'population',
			


                // 9to18month
                // 18to59month
                // 5to7year
                // 7to13year
                // 13to16year
                // more16year

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

                Forms\Components\Section::make('Usia 9 - < 18 Bulan')
                    ->description('Usia 9 sampai kurang dari 18 bulan')
                    ->visible(fn ($get) => $get('year'))
                    ->schema([
                        Forms\Components\TextInput::make('suspect_9to18month')
                            ->label('Jumlah suspek atau kasus')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\TextInput::make('population_9to18month')
                            ->label('Total Populasi')
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
                        Forms\Components\TextInput::make('population_18to59month')
                            ->label('Total Populasi')
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
                        Forms\Components\TextInput::make('population_5to7year')
                            ->label('Total Populasi')
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
                        Forms\Components\TextInput::make('population_7to13year')
                            ->label('Total Populasi')
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
                        Forms\Components\TextInput::make('population_13to16year')
                            ->label('Total Populasi')
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
                        Forms\Components\TextInput::make('population_more16year')
                            ->label('Total Populasi')
                            ->numeric()
                            ->inlineLabel()
                            ->required(),
                    ]),

          


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                    ->label("Jumlah suspect atau kasus"),
                Tables\Columns\TextColumn::make("population")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Total Populasi"),
                Tables\Columns\TextColumn::make("attackRate")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Attack Rate (AR)"),
            ])
            ->filters([
                
                SelectFilter::make('year')
                    ->label('Tahun')
                    ->options(function () {
                        
                        $yearExists = static::getModel()::select('year')->where('kode_fasyankes', auth()->user()->kode_fasyankes)->distinct()->get()->pluck('year');
                        
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
                    ->attribute('year')

            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->form([





                        Forms\Components\Section::make('Usia 9 - < 18 Bulan')
                            ->description('Usia 9 sampai kurang dari 18 bulan')
                            ->visible(fn ($record) => $record->age_group === '9 - <18 bulan')
                            ->schema([
                                Forms\Components\TextInput::make('suspect')
                                    ->label('Jumlah suspek atau kasus')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                                Forms\Components\TextInput::make('population')
                                    ->label('Total Populasi')
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
                                Forms\Components\TextInput::make('population')
                                    ->label('Total Populasi')
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
                                Forms\Components\TextInput::make('population')
                                    ->label('Total Populasi')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                            ]),
                        Forms\Components\Section::make('Usia 7 - < 13 Tahun')
                            ->description('Usia 7 sampai kurang dari 13')
                            ->visible(fn ($record) => $record->age_group === '7 - <13tahun')
                            ->schema([
                                Forms\Components\TextInput::make('suspect')
                                    ->label('Jumlah suspek atau kasus')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                                Forms\Components\TextInput::make('population')
                                    ->label('Total Populasi')
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
                                Forms\Components\TextInput::make('population')
                                    ->label('Total Populasi')
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
                                Forms\Components\TextInput::make('population')
                                    ->label('Total Populasi')
                                    ->numeric()
                                    ->inlineLabel()
                                    ->required(),
                            ]),













                        // Forms\Components\Section::make(function ($record) {

                        //         if ($record->age_group === '9 - <18 bulan' ) {
                        //             return 'Usia 9 - < 18 Bulan';
                        //         } elseif ($record->age_group === '18 - 59 bulan' ) {
                        //             return 'Usia 18 - 59 Bulan';
                        //         } elseif ($record->age_group === '5 - <7 tahun' ) {
                        //             return 'Usia 5 - < 7 Tahun';
                        //         } elseif ($record->age_group === '7 - <13tahun' ) {
                        //             return 'Usia 7 - < 13 Tahun';
                        //         } elseif ($record->age_group === '13 - <16 tahun' ) {
                        //             return 'Usia 13 - < 16 Tahun';
                        //         } elseif ($record->age_group === '≥ 16 tahun' ) {
                        //             return 'Usia ≥ 16 tahun';
                        //         } else {
                        //             return '';
                        //         }

                        //     })
                        //     ->description(function ($record) {

                        //         if ($record->age_group === '9 - <18 bulan' ) {
                        //             return 'Usia 9 sampai kurang dari 18 bulan';
                        //         } elseif ($record->age_group === '18 - 59 bulan' ) {
                        //             return 'Usia 18 sampai 59 Bulan';
                        //         } elseif ($record->age_group === '5 - <7 tahun' ) {
                        //             return 'Usia 5 sampai kurang dari 7 tahun';
                        //         } elseif ($record->age_group === '7 - <13tahun' ) {
                        //             return 'Usia 7 sampai kurang dari 13';
                        //         } elseif ($record->age_group === '13 - <16 tahun' ) {
                        //             return 'Usia 13 sampai kurang dari 16 tahun';
                        //         } elseif ($record->age_group === '≥ 16 tahun' ) {
                        //             return 'Usia lebih dari sama dengan 16 tahun';
                        //         } else {
                        //             return '';
                        //         }

                                
                        //     })
                        //     ->schema([
                        //         Forms\Components\TextInput::make('suspect_9to18month')
                        //             ->label('Jumlah suspek atau kasus')
                        //             ->numeric()
                        //             ->inlineLabel()
                        //             ->required(),
                        //         Forms\Components\TextInput::make('population_9to18month')
                        //             ->label('Total Populasi')
                        //             ->numeric()
                        //             ->inlineLabel()
                        //             ->required(),
                        //     ]),
                    ])
                    ->mountUsing( function ($form, $record) {
                        // dd($record);
                        $form->fill($record->attributesToArray()); 
                    })
                    ->action(function ($data, $record) {
                        $record->update($data);

                        Notification::make() 
                            ->success()
                            ->title('Berhasil Disimpan')
                            ->send(); 
                        // dd($data, $record);
                    })
                // Tables\Actions\EditAction::make()
                //     ->visible(auth()->user()->hasRole('Puskesmas')),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->emptyStateHeading('Data Kosong')
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageForm3s::route('/'),
        ];
    }
}
