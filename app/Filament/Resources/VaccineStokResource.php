<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VaccineStokResource\Pages;
use App\Filament\Resources\VaccineStokResource\RelationManagers;
use App\Models\Vaccine;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Enums\FiltersLayout;

class VaccineStokResource extends Resource
{
    protected static ?string $model = Vaccine::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Stok Vaksin';

    protected static ?string $slug = 'stok-vaksin';

    protected static ?string $label = 'Stok Vaksin';

    protected static ?string $pluralModelLabel = 'Stok Vaksin';

    protected static ?string $navigationGroup = 'VAKSIN';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole(['Puskesmas', 'Kemkes']); 
    }


    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->label('Tanggal')
                    ->default(now())
                    ->inlineLabel()
                    ->required(),
                Forms\Components\Select::make('category')
                    ->label('Kategori')
                    ->native(false)
                    ->options([
                        'penambahan' => 'Penambahan',
                        'pengurangan' => 'Pengurangan',
                    ])
                    ->inlineLabel()
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->label('Jumlah')
                    ->inlineLabel()
                    ->minValue(1)
                    ->live()
                    ->numeric()
                    ->required(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) use ($table) {
                
                $query->join('fasyankes', 'vaccines.kode_fasyankes', '=', 'fasyankes.kode_fasyankes');

                if (auth()->user()->kode_fasyankes) {
                    return $query->where('kode_fasyankes', auth()->user()->kode_fasyankes);
                }

                return $query;
                
            })
            ->columns([
                Tables\Columns\TextColumn::make("fasyankes.name")
                    ->placeholder('-')
                    ->sortable()
                    ->hidden(auth()->user()->hasRole('Puskesmas'))
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Puskesmas"),
                Tables\Columns\TextColumn::make('date')
                    ->dateTime('d-M-Y')
                    ->sortable()
                    ->label('Tanggal'),
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->color(fn (string $state): string => match ($state) {
                        'penambahan' => 'success',
                        'pengurangan' => 'danger',
                    })
                    ->label('Kategori'),
                Tables\Columns\TextColumn::make('amount')
                    ->formatStateUsing(fn ($record, $state) => $record->category == 'penambahan' ? '+'.$state : '-'.$state )
                    ->label('Jumlah'),
            ])
            ->defaultSort(function (Builder $query): Builder {
                return $query
                    ->orderBy('name', 'ASC')
                    ->orderBy('date', 'DESC');
            })
            ->paginated([30, 60, 100, 'all'])
            ->defaultPaginationPageOption(60)
            ->emptyStateHeading('Data Kosong')
            ->filters([
                
                Tables\Filters\Filter::make('date_range')
                ->label('Rentang Tanggal')
                ->form([
                    DatePicker::make('start_date')
                        ->label('Tanggal Mulai')
                        ->default(now()->startOfYear()->toDateString())
                        ->required(),
                    DatePicker::make('end_date')
                        ->label('Tanggal Akhir')
                        ->default(now()->endOfYear()->toDateString())
                        ->required(),
                ])
                ->query(function (Builder $query, array $data) {
                    return $query->whereBetween('date', [$data['start_date'], $data['end_date']]);
                }),

            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageVaccineStoks::route('/'),
        ];
    }
}
