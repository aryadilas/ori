<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SummarySckOriResource\Pages;
use App\Filament\Resources\SummarySckOriResource\RelationManagers;
use App\Models\ViewSummarySckOri;
use App\Models\Fasyankes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;

class SummarySckOriResource extends Resource
{
    protected static ?string $model = ViewSummarySckOri::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Summary SCK ORI';

    protected static ?string $slug = 'summary-sck-ori';

    protected static ?string $label = 'Summary SCK ORI';

    protected static ?string $pluralModelLabel = 'Summary SCK ORI';

    protected static ?string $navigationGroup = 'INPUT KAJIAN EPIDEMIOLOGI';

    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        return false; 
    }

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
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('usia')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->placeholder('-')
                    ->label('Usia'),
                Tables\Columns\TextColumn::make('target')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->placeholder('-')
                    ->label('Jumlah Sasaran'),
                Tables\Columns\TextColumn::make('cr2_target')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->placeholder('-')
                    ->label('Sasaran MR kelas 1 atau Campak Rubela 2*'),
                Tables\Columns\TextColumn::make('cr1_abs')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->placeholder('-')
                    ->label('Jumlah Absolute Campak Rubela 1'),
                Tables\Columns\TextColumn::make('cr2_abs')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->placeholder('-')
                    ->label('Jumlah Absolute Campak Rubela 2'),
                Tables\Columns\TextColumn::make('crBias_abs')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->placeholder('-')
                    ->label('Jumlah Absolute Campak Rubela BIAS'),
                Tables\Columns\TextColumn::make('crAddition_abs')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->placeholder('-')
                    ->label('Jumlah Absolute Campak Rubela Tambahan'),
                Tables\Columns\TextColumn::make('cr1_scope')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->placeholder('-')
                    ->label('% Cakupan Campak Rubela 1'),
                Tables\Columns\TextColumn::make('cr2_scope')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->placeholder('-')
                    ->label('% Cakupan Campak Rubela 2'),
                Tables\Columns\TextColumn::make('crBias_scope')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->placeholder('-')
                    ->label('% Cakupan Campak Rubela BIAS'),
                Tables\Columns\TextColumn::make('crAddition_scope')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->placeholder('-')
                    ->label('% Cakupan Campak Rubela Tambahan'),
            ])
            ->defaultSort('age_group', 'ASC')
            ->emptyStateHeading('Data Kosong')
            ->filters([
                
                SelectFilter::make('year')
                    ->label('Tahun')
                    ->options(function () {
                        
                        $yearExists = static::getModel()::select('year')
                            ->when(auth()->user()->kode_fasyankes, function ($query) {
                                return $query->where('kode_fasyankes', auth()->user()->kode_fasyankes);
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
                    ->attribute('year'),

                SelectFilter::make('fasyankes')
                    ->label('Fasyankes')
                    ->hidden(auth()->user()->hasRole('Puskesmas'))
                    ->options(function () {

                        $fasyankesExists = Fasyankes::select('name', 'kode_fasyankes')
                            ->distinct()
                            ->get()
                            ->pluck('name', 'kode_fasyankes');
                        
                        return $fasyankesExists;

                    })
                    ->default('32760200005')
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
            'index' => Pages\ManageSummarySckOris::route('/'),
        ];
    }
}
