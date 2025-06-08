<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkdrInputResource\Pages;
use App\Filament\Resources\SkdrInputResource\RelationManagers;
use App\Models\Skdr;
use App\Models\Notification;
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
                Tables\Columns\SelectColumn::make('status')
                    ->label('Status')
                    ->afterStateUpdated(function ($record, $state) {
                        
                        $tahun = now()->format('Y'); 

                        $data = Skdr::where('year', $tahun)
                            ->orderBy('kode_fasyankes')
                            ->where('status', 'KLB')
                            ->with('fasyankes')
                            ->orderBy('week');
                        
                        if (auth()->user()->hasRole('Puskesmas')) {
                            $data->where('kode_fasyankes', auth()->user()->kode_fasyankes);
                        }

                        $data = $data->get()->groupBy('kode_fasyankes');

                        
                        $results = [];
                        
                        foreach ($data as $kodeFasyankes => $records) {
                            $weeks = $records->pluck('case_count', 'week')->toArray(); 

                            $fasyankesName = $records->first()->fasyankes->name;

                            $allWeeks = array_keys($weeks);
                            sort($allWeeks);

                            for ($i = 0; $i < count($allWeeks); $i++) {
                                $w1 = $allWeeks[$i];
                                $w2 = $w1 + 1;
                                $w3 = $w1 + 2;
                                $w4 = $w1 + 3;

                                $caseW1 = $weeks[$w1] ?? 0;
                                $caseW2 = $weeks[$w2] ?? 0;
                                $caseW3 = $weeks[$w3] ?? 0;
                                $caseW4 = $weeks[$w4] ?? 0;

                                if ($caseW1 == 0 || $caseW2 == 0 || $caseW3 == 0 || $caseW4 == 0) {
                                    continue;                    
                                }

                                $totalCases = $caseW1 + $caseW2 + $caseW3 + $caseW4;

                                if ($totalCases >= 5) {

                                    $notification = Notification::with('fasyankes')
                                        ->where('kode_fasyankes', $kodeFasyankes)
                                        ->where('start_week', $w1)
                                        ->where('category', 'klb')
                                        ->where('end_week', $caseW4 
                                                            ? $w4 
                                                            : ($caseW3 
                                                                ? $w3 
                                                                : ($caseW2 
                                                                    ? $w2 
                                                                    : $w1))
                                        )
                                        ->where('total_case', $totalCases)
                                        ->first();

                                    if (!$notification) {
                                        
                                        Notification::create([
                                            'kode_fasyankes' => $record->kode_fasyankes,
                                            'total_case' => $totalCases,
                                            'start_week' => $w1,
                                            'end_week' => $w4,
                                            'category' => 'klb',
                                            'status' => 'confirmed',
                                        ]);

                                    } 

                                }

                            }

                        }


                        // algoritma cek KLB di notif
                        // create notif kalo KLB atau tidak


                    })
                    ->options([
                        'KLB' => 'KLB',
                        'Bukan KLB' => 'Bukan KLB',
                    ])
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
