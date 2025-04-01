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
                Forms\Components\Section::make('Usia 9 - < 18 Bulan')
                    ->description('Usia 9 sampai kurang dari 18 bulan')
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(auth()->user()->hasRole('Puskesmas')),
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
