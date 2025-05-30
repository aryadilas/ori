<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkdrInputResource\Pages;
use App\Filament\Resources\SkdrInputResource\RelationManagers;
use App\Models\Skdr;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkdrInputResource extends Resource
{
    protected static ?string $model = Skdr::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Petugas Input Kasus';

    protected static ?string $slug = 'input-skdr';

    protected static ?string $label = 'Petugas Input Kasus';

    protected static ?string $pluralModelLabel = 'Petugas Input Kasus';

    protected static ?string $navigationGroup = 'INTEGRASI API SKDR CAMPAK-RUBELA';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole(['Super Admin', 'Dinkes', 'Puskesmas']); 
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('officer_name')
                    ->label('Nama Petugas')
                    ->inlineLabel()
                    ->required(),
                Forms\Components\Select::make('week')
                    ->label('Minggu Ke')
                    ->native(false)
                    ->options(function (){
                        $options = [];
                        for ($i = 1; $i <= 52; $i++) { 
                            $options[$i] = $i;
                        }
                        return $options;
                    })
                    ->inlineLabel()
                    ->required(),
                Forms\Components\Select::make('year')
                    ->label('Tahun')
                    ->native(false)
                    ->options(function (){
                        $options = [];
                        for ($i = 2018; $i <= now()->format('Y')+5; $i++) { 
                            $options[$i] = $i;
                        }
                        return $options;
                    })
                    ->default(now()->format('Y'))
                    ->inlineLabel()
                    ->required(),
                Forms\Components\TextInput::make('case_count')
                    ->label('Jumlah Kasus')
                    ->inlineLabel()
                    ->minValue(0)
                    ->live()
                    ->numeric()
                    ->required(),
                // Forms\Components\Repeater::make('patient_names')
                //     ->label('Pasien')
                //     ->schema([
                //         Forms\Components\TextInput::make('name')->required(),
                //     ])
                //     ->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) use ($table) {

                // dump($table);

                if (auth()->user()->hasRole('Puskesmas')) {
                    return $query->where('kode_fasyankes', auth()->user()->kode_fasyankes);
                }
                
                // if (! $this->getTableSortColumn()) {
                //     return $query->orderBy('kode_fasyankes')
                //         ->orderBy('week', 'desc');
                // }

                return $query->orderBy('kode_fasyankes');

            })
            ->columns([
                Tables\Columns\TextColumn::make('fasyankes.name')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->hidden(auth()->user()->hasRole('Puskesmas'))
                    ->label('Fasyankes'),
                Tables\Columns\TextColumn::make('officer_name')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label('Petugas'),
                Tables\Columns\TextColumn::make('week')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->sortable()
                    ->label('Minggu Ke-'),
                Tables\Columns\TextColumn::make('case_count')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label('Kasus'),
                // Tables\Columns\TextColumn::make('patient_names')
                //     ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                //     ->formatStateUsing(fn ($state) => 
                //         collect(json_decode("[$state]", true))
                //             ->pluck('name')
                //             ->join(', ') ?: '-'
                //     )
                //     ->label('Nama Pasien')
            ])
            ->defaultSort('week', 'desc')
            ->paginated([30, 60, 100, 'all'])
            ->defaultPaginationPageOption(60)
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageSkdrInputs::route('/'),
        ];
    }
}
