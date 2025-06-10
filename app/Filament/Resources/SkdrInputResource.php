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
use Illuminate\Support\Facades\DB;

class SkdrInputResource extends Resource
{
    protected static ?string $model = Skdr::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Petugas Input Kasus';

    protected static ?string $slug = 'input-skdr';

    protected static ?string $label = 'Petugas Input Kasus';

    protected static ?string $pluralModelLabel = 'Petugas Input Kasus';

    protected static ?string $navigationGroup = 'PEMANTAUAN KASUS';

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
                    ->options(function () {
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
                    ->options(function () {
                        $options = [];
                        for ($i = 2018; $i <= now()->format('Y') + 5; $i++) {
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
            ]);
    }

    // Helper method untuk mengecek apakah record adalah minggu terakhir dari 4 minggu berturut-turut
    private static function isLastWeekOfFourConsecutiveWeeks($record): bool
    {
        $tahun = $record->year;
        $kodeFasyankes = $record->kode_fasyankes;
        $currentWeek = $record->week;

        // Ambil data 4 minggu berturut-turut yang berakhir di minggu ini
        $weeks = [$currentWeek - 3, $currentWeek - 2, $currentWeek - 1, $currentWeek];

        // Pastikan semua minggu valid (tidak negatif)
        if (min($weeks) < 1) {
            return false;
        }

        // Ambil data kasus untuk 4 minggu berturut-turut
        $cases = Skdr::where('year', $tahun)
            ->where('kode_fasyankes', $kodeFasyankes)
            ->whereIn('week', $weeks)
            ->pluck('case_count', 'week')
            ->toArray();

        // Cek apakah semua 4 minggu memiliki data dan tidak ada yang 0
        $totalCases = 0;
        foreach ($weeks as $week) {
            if (!isset($cases[$week]) || $cases[$week] == 0) {
                return false;
            }
            $totalCases += $cases[$week];
        }

        // Cek apakah total kasus minimal 5
        return $totalCases >= 5;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) use ($table) {
                if (auth()->user()->hasRole('Puskesmas')) {
                    return $query->where('kode_fasyankes', auth()->user()->kode_fasyankes);
                }

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
                    ->disabled(function ($record) {
                        // Disable jika bukan minggu terakhir dari 4 minggu berturut-turut dengan minimal 5 kasus
                        return !self::isLastWeekOfFourConsecutiveWeeks($record);
                    })
                    ->options([
                        'KLB' => 'KLB',
                        'Bukan KLB' => 'Bukan KLB',
                    ])
                    ->afterStateUpdated(function ($record, $state) {
                        $tahun = $record->year;
                        $kodeFasyankes = $record->kode_fasyankes;
                        $currentWeek = $record->week;

                        // Ambil data 3 minggu sebelumnya
                        $weeksToUpdate = [$currentWeek - 3, $currentWeek - 2, $currentWeek - 1];

                        // Hapus status sebelumnya untuk 3 minggu sebelumnya
                        Skdr::where('year', $tahun)
                            ->where('kode_fasyankes', $kodeFasyankes)
                            ->whereIn('week', $weeksToUpdate)
                            ->update(['status' => null]);

                        // Hapus status sebelumnya untuk minggu saat ini
                        Skdr::where('year', $tahun)
                            ->where('kode_fasyankes', $kodeFasyankes)
                            ->where('week', $currentWeek)
                            ->update(['status' => null]);

                        // Update status untuk 3 minggu sebelumnya
                        Skdr::where('year', $tahun)
                            ->where('kode_fasyankes', $kodeFasyankes)
                            ->whereIn('week', $weeksToUpdate)
                            ->update(['status' => $state]);

                        // Update status untuk minggu saat ini
                        Skdr::where('year', $tahun)
                            ->where('kode_fasyankes', $kodeFasyankes)
                            ->where('week', $currentWeek)
                            ->update(['status' => $state]);

                        // Ambil data 4 minggu berturut-turut
                        $weeksData = Skdr::where('year', $tahun)
                            ->where('kode_fasyankes', $kodeFasyankes)
                            ->whereIn('week', [$currentWeek - 3, $currentWeek - 2, $currentWeek - 1, $currentWeek])
                            ->get();

                        // Pastikan ada data untuk semua 4 minggu
                        if ($weeksData->count() == 4) {
                            $totalCases = $weeksData->sum('case_count');

                            if ($totalCases >= 5) {
                                // Periksa apakah notifikasi sudah ada
                                $notification = Notification::where('kode_fasyankes', $kodeFasyankes)
                                    ->where('start_week', $currentWeek - 3)
                                    ->where('end_week', $currentWeek)
                                    ->where('category', 'klb')
                                    ->first();

                                // Jika notifikasi sudah ada, update statusnya
                                if ($notification) {
                                    $notification->update([
                                        'status' => $state == 'KLB' ? 'confirmed' : 'false',
                                    ]);
                                } else {
                                    // Jika notifikasi belum ada, buat notifikasi baru
                                    Notification::create([
                                        'kode_fasyankes' => $kodeFasyankes,
                                        'total_case' => $totalCases,
                                        'start_week' => $currentWeek - 3,
                                        'end_week' => $currentWeek,
                                        'category' => 'klb',
                                        'status' => $state == 'KLB' ? 'confirmed' : 'false',
                                    ]);
                                }
                            }
                        }
                    })
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
