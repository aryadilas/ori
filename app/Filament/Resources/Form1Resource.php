<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Form1Resource\Pages;
use App\Filament\Resources\Form1Resource\RelationManagers;
use App\Models\Form1Answer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;

class Form1Resource extends Resource
{
    protected static ?string $model = Form1Answer::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Luas Wilayah';

    protected static ?string $slug = 'luas-wilayah';

    protected static ?string $label = 'Luas Wilayah';

    protected static ?string $pluralModelLabel = 'Luas Wilayah';

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
            ->columns(1)
            ->schema([
                
                Forms\Components\Select::make('year')
                    ->label('Tahun')
                    ->live()
                    ->default(now()->year)
                    ->options(function () {
                        $currentYear = now()->year;
                        $startYear = $currentYear - 2;
                        $endYear = $currentYear + 2;

                        $options = [];
                        for ($i = $startYear; $i <= $endYear; $i++) { 

                            $options[$i] = $i;

                        }

                        return $options;

                    })
                    ->inlineLabel()
                    ->required(),
                Forms\Components\TextInput::make('village_name')
                    ->label('Desa/Kelurahan')
                    ->inlineLabel()
                    ->required(),

                Forms\Components\Radio::make('q1')
                    ->label('1. Sedang terjadi KLB campak/rubela/mix (Y/T)')
                    ->options([
                        'y' => 'Y',
                        't' => 'T',
                    ])
                    ->required(),
                Forms\Components\Radio::make('q2')
                    ->label('2. Adanya mobilitas penduduk dari dan ke wilayah KLB (Y/T)')
                    ->options([
                        'y' => 'Y',
                        't' => 'T',
                    ])
                    ->required(),

                Forms\Components\Section::make('3. Campak Rubela 1')
                    ->schema([
                        Forms\Components\TextInput::make('q3a')
                            ->label('3A. Jumlah tahun arsip data tersedia (3 s/d 5 tahun terakhir)')
                            ->inlineLabel()
                            ->numeric()
                            ->live()
                            ->required(),
                        Forms\Components\TextInput::make('q3b')
                            ->label('3B. Jumlah kumulatif cakupan imunisasi (%)')
                            ->inlineLabel()
                            ->numeric()
                            ->maxValue(fn ($get) => $get('q3a') * 100)
                            ->required(),        
                    ]),

                Forms\Components\Section::make('4. Campak Rubela 2')
                    ->schema([
                        Forms\Components\TextInput::make('q4a')
                            ->label('4A. Jumlah tahun arsip data tersedia (3 s/d 5 tahun terakhir)')
                            ->inlineLabel()
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('q4b')
                            ->label('4B. Jumlah kumulatif cakupan imunisasi (%)')
                            ->inlineLabel()
                            ->numeric()
                            ->required(),
                    ]),

                Forms\Components\Section::make('5. Campak Rubela BIAS (Kelas 1 SD/Sederajat)')
                    ->schema([
                        Forms\Components\TextInput::make('q5a')
                            ->label('5A. Jumlah tahun arsip data tersedia (3 s/d 5 tahun terakhir)')
                            ->inlineLabel()
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('q5b')
                            ->label('5B. Jumlah kumulatif cakupan imunisasi (%)')
                            ->inlineLabel()
                            ->numeric()
                            ->required(),
                    ]),

                Forms\Components\Section::make('6. Campak Rubela Tambahan (BIAN/kampanye/ORI)')
                    ->schema([
                        Forms\Components\TextInput::make('q6a')
                            ->label('6A. Berapa tahun arsip data tersedia?')
                            ->inlineLabel()
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('q6b')
                            ->label('6B. Jumlah kumulatif cakupan imunisasi (%)')
                            ->inlineLabel()
                            ->numeric()
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
                Tables\Columns\TextColumn::make("village_name")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Desa/Kelurahan"),
                Tables\Columns\TextColumn::make("q1")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->formatStateUsing(fn ($state) => strtoupper($state))
                    ->label("Sedang terjadi KLB campak/rubela/mix"),
                Tables\Columns\TextColumn::make("q2")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->formatStateUsing(fn ($state) => strtoupper($state))
                    ->label("Adanya mobilitas penduduk dari dan ke wilayah KLB"),

                Tables\Columns\TextColumn::make("q3a")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Jumlah tahun arsip data tersedia (3 s/d 5 tahun terakhir) (Campak Rubela 1)"),
                Tables\Columns\TextColumn::make("q3b")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Jumlah kumulatif cakupan imunisasi (%) (Campak Rubela 1)"),
                Tables\Columns\TextColumn::make("q3average")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("% Rata-rata"),
                Tables\Columns\TextColumn::make("q3average80")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->formatStateUsing(fn ($state) => strtoupper($state))
                    ->label("Rata-rata <80%"),

                Tables\Columns\TextColumn::make("q4a")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Jumlah tahun arsip data tersedia (3 s/d 5 tahun terakhir) (Campak Rubela 2)"),
                Tables\Columns\TextColumn::make("q4b")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Jumlah kumulatif cakupan imunisasi (%) (Campak Rubela 2)"),
                Tables\Columns\TextColumn::make("q4average")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("% Rata-rata"),
                Tables\Columns\TextColumn::make("q4average80")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->formatStateUsing(fn ($state) => strtoupper($state))
                    ->label("Rata-rata <80%"),

                Tables\Columns\TextColumn::make("q5a")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Jumlah tahun arsip data tersedia (3 s/d 5 tahun terakhir) (Campak Rubela BIAS (Kelas 1 SD/Sederajat))"),
                Tables\Columns\TextColumn::make("q5b")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Jumlah kumulatif cakupan imunisasi (%) (Campak Rubela BIAS (Kelas 1 SD/Sederajat))"),
                Tables\Columns\TextColumn::make("q5average")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("% Rata-rata"),
                Tables\Columns\TextColumn::make("q5average80")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->formatStateUsing(fn ($state) => strtoupper($state))
                    ->label("Rata-rata <80%"),

                Tables\Columns\TextColumn::make("q6a")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Berapa tahun arsip data tersedia? (Campak Rubela Tambahan (BIAN/kampanye/ORI))"),
                Tables\Columns\TextColumn::make("q6b")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Jumlah kumulatif cakupan imunisasi (%) (Campak Rubela Tambahan (BIAN/kampanye/ORI))"),
                Tables\Columns\TextColumn::make("q6average")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("% Rata-rata"),
                Tables\Columns\TextColumn::make("q6average80")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->formatStateUsing(fn ($state) => strtoupper($state))
                    ->label("Rata-rata <80%"),


                Tables\Columns\TextColumn::make("summary")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Kesimpulan")
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

                        // [
                        // '2025' => '2025',
                        // '2026' => '2026',
                        // ]
                    })
                    ->default(now()->year)
                    ->selectablePlaceholder(false)
                    ->attribute('year')

            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(auth()->user()->hasRole('Puskesmas')),
                Tables\Actions\DeleteAction::make()
                    ->visible(auth()->user()->hasRole('Puskesmas')),
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
            'index' => Pages\ManageForm1s::route('/'),
        ];
    }
}
