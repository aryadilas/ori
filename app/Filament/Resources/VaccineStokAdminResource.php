<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VaccineStokAdminResource\Pages;
use App\Filament\Resources\VaccineStokAdminResource\RelationManagers;
use App\Models\Vaccine;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

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
        return auth()->user()->hasRole('Dinkes'); 
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) use ($table) {

                $query->groupBy('kode_fasyankes')->with('fasyankes');
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
            ])
            ->defaultSort('date', 'desc')
            ->paginated([30, 60, 100, 'all'])
            ->defaultPaginationPageOption(60)
            ->emptyStateHeading('Data Kosong')
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
            'index' => Pages\ManageVaccineStokAdmins::route('/'),
        ];
    }
}
