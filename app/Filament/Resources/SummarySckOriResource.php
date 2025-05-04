<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SummarySckOriResource\Pages;
use App\Filament\Resources\SummarySckOriResource\RelationManagers;
use App\Models\ViewSummarySckOri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SummarySckOriResource extends Resource
{
    protected static ?string $model = ViewSummarySckOri::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Summary SCK ORI';

    protected static ?string $slug = 'summary-sck-ori';

    protected static ?string $label = 'Summary SCK ORI';

    protected static ?string $pluralModelLabel = 'Summary SCK ORI';

    protected static ?string $navigationGroup = 'DATA';

    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('Puskesmas'); 
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
            ->filters([
                //
            ])
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
