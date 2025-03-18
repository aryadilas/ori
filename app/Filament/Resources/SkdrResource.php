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

    protected static ?string $navigationLabel = 'Input TKDR';

    protected static ?string $slug = 'input-skdr';

    protected static ?string $label = 'Input SKDR';

    protected static ?string $pluralModelLabel = 'Input SKDR';

    protected static ?string $navigationGroup = 'SKDR';

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
                    ->minValue(1)
                    ->live()
                    ->numeric()
                    ->required(),
                Forms\Components\Repeater::make('patient_names')
                    ->label('Pasien')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required(),
                    ])
                    ->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) use ($table) {
                $weeks = range(1, 53);
                $selectRaw = 'id, officer_name';

                foreach ($weeks as $week) {
                    $selectRaw .= ", MAX(CASE WHEN week = {$week} THEN case_count END) AS M_{$week}";
                }

                return $query
                    ->selectRaw($selectRaw)
                    ->where('year', now()->format('Y'))
                    ->groupBy('officer_name');
            })
            ->columns(
                collect(range(1, 53))->map(function ($week) {
                    return Tables\Columns\TextColumn::make("M_{$week}")
                        ->placeholder('-')
                        ->formatStateUsing(fn($state) => $state == 0 || !$state ? '-' : $state)
                        ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                        ->label("M-{$week}");
                })->toArray()
            )
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
            'index' => Pages\ManageSkdrs::route('/'),
        ];
    }
}
