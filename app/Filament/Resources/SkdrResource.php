<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkdrResource\Pages;
use App\Filament\Resources\SkdrResource\RelationManagers;
use App\Models\Skdr;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkdrResource extends Resource
{
    protected static ?string $model = Skdr::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Rekapitulasi Mingguan';

    protected static ?string $slug = 'rekap-skdr';

    protected static ?string $label = 'Rekapitulasi Mingguan';

    protected static ?string $pluralModelLabel = 'Rekapitulasi Mingguan Aplikasi Sistem Kewaspadaan Dini dan Respon (SKDR)';

    protected static ?string $navigationGroup = 'INTEGRASI API SKDR CAMPAK-RUBELA';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole(['Super Admin', 'Dinkes', 'Puskesmas']); 
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([]);
    }

    public static function table(Table $table): Table
    {

        $weekColumns = collect(range(1, 53))->map(function ($week) {
            return Tables\Columns\TextColumn::make("M_{$week}")
                ->placeholder('-')
                ->formatStateUsing(fn($state) => $state == 0 || !$state ? '-' : $state)
                ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                ->label("M-{$week}");
        })->toArray();

        if (auth()->user()->hasRole('Puskesmas')) {
            $beforeColumns = [];
            $afterColumns = [
                Tables\Columns\TextColumn::make('total')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label('Total')
            ];
        } else {
            $beforeColumns = [
                Tables\Columns\TextColumn::make('fasyankes.name')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label('Fasyankes')
            ];
            $afterColumns = [
                Tables\Columns\TextColumn::make('total')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label('Total')
            ];
        }

        

        $columns = array_merge($beforeColumns, $weekColumns, $afterColumns);

        return $table
            ->modifyQueryUsing(function (Builder $query) use ($table) {
                $weeks = range(1, 53);
                $selectRaw = 'id, officer_name, kode_fasyankes';

                foreach ($weeks as $week) {
                    $selectRaw .= ", MAX(CASE WHEN week = {$week} THEN case_count END) AS M_{$week}";
                }

                $selectRaw .= ", (";
                $selectRaw .= implode(' + ', array_map(function($week) {
                    return "COALESCE(MAX(CASE WHEN week = {$week} THEN case_count END), 0)";
                }, $weeks));
                $selectRaw .= ") AS total";


                if (auth()->user()->hasRole('Puskesmas')) {
                    $query
                        ->selectRaw($selectRaw)
                        ->where('year', now()->format('Y'))
                        ->where('kode_fasyankes', auth()->user()->kode_fasyankes)
                        ->groupBy('kode_fasyankes');
                } else {
                    $query
                        ->selectRaw($selectRaw)
                        ->where('year', now()->format('Y'))
                        ->groupBy('kode_fasyankes');
                }
                
                return $query;
                
            })
            ->columns(
                $columns
            )
            ->paginated(false)
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ManageSkdrs::route('/'),
        ];
    }
}
