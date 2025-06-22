<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OriImplementationResource\Pages;
use App\Filament\Resources\OriImplementationResource\RelationManagers;
use App\Models\OriImplementation;
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

class OriImplementationResource extends Resource
{
    protected static ?string $model = OriImplementation::class;




    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Hasil Pelaksanaan ORI';

    protected static ?string $slug = 'input-pelaksanaan-ori';

    protected static ?string $label = 'Hasil Pelaksanaan ORI';

    protected static ?string $pluralModelLabel = 'Hasil Pelaksanaan ORI';

    protected static ?string $navigationGroup = 'PELAPORAN';

    protected static ?int $navigationSort = 4;

    
    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('Puskesmas'); 
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
            ->columns(1)
            ->schema([
                Forms\Components\TextInput::make('village_name')
                    ->required()
                    ->label('Desa/Kelurahan')
                    ->inlineLabel(),
                Forms\Components\TextInput::make('child_name')
                    ->required()
                    ->label('Nama Anak')
                    ->inlineLabel(),
                Forms\Components\DatePicker::make('birthday')
                    ->required()
                    ->label('Tanggal Lahir')
                    ->inlineLabel(),
                Forms\Components\Select::make('gender')
                    ->options([
                        'L' => 'Laki - Laki',
                        'P' => 'Perempuan',
                    ])
                    ->required()
                    ->label('Jenis Kelamin')
                    ->inlineLabel(),
                Forms\Components\TextInput::make('child_nik')
                    ->required()
                    ->label('NIK Anak')
                    ->inlineLabel(),
                Forms\Components\TextInput::make('parent_nik')
                    ->required()
                    ->label('NIK Orang Tua')
                    ->inlineLabel(),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->label('Alamat')
                    ->inlineLabel(),
                Forms\Components\TextInput::make('telp')
                    ->tel()
                    ->required()
                    ->label('No HP')
                    ->inlineLabel(),
                Forms\Components\DatePicker::make('immunized_date')
                    ->required()
                    ->label('Tanggal Imunisasi')
                    ->inlineLabel(),
                Forms\Components\TextInput::make('batch_number')
                    ->required()
                    ->numeric()
                    ->minLength(8)
                    ->maxLength(8)
                    ->label('Nomor Batch')
                    ->inlineLabel(),
                // Forms\Components\Select::make('status')
                //     ->options([
                //         'Hadir' => 'Hadir',
                //         'Tidak Hadir' => 'Tidak Hadir',
                //     ])
                //     ->required()
                //     ->label('Status Kehadiran')
                //     ->inlineLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->header(function () {
                if (auth()->user()->hasRole('Puskesmas')) {
                    return view('filament.header.custom-header', ['file_path' => '/template/input_pelaksanaan_ori.xlsx']);
                }
            })
            ->columns([
                Tables\Columns\TextColumn::make("fasyankes.name")
                    ->placeholder('-')
                    ->hidden(auth()->user()->hasRole('Puskesmas'))
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Puskesmas"),
                Tables\Columns\TextColumn::make('village_name')
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Kelurahan"),
                Tables\Columns\TextColumn::make('child_name')
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Nama Anak"),
                Tables\Columns\TextColumn::make('birthday')
                    ->date()
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Tanggal Lahir")
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Jenis Kelamin"),
                Tables\Columns\TextColumn::make('child_nik')
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("NIK Anak"),
                Tables\Columns\TextColumn::make('parent_nik')
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("NIK Orang Tua"),
                Tables\Columns\TextColumn::make('address')
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Alamat"),
                Tables\Columns\TextColumn::make('telp')
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("No HP"),
                Tables\Columns\TextColumn::make('immunized_date')
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Tanggal Imunisasi"),
                Tables\Columns\TextColumn::make('batch_number')
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Nomor Batch"),
                // Tables\Columns\TextColumn::make('status')
                //     ->placeholder('-')
                //     ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                //     ->label("Status Kehadiran"),
            ])
            ->filters([

                    SelectFilter::make('fasyankes')
                    ->label('Fasyankes')
                    ->hidden(auth()->user()->hasRole('Puskesmas'))
                    ->options(function () {

                        $fasyankesExists = Fasyankes::select('name', 'kode_fasyankes')
                            ->distinct()
                            ->get()
                            ->pluck('name', 'kode_fasyankes');
                        
                        return collect(['' => 'SEMUA'])->union($fasyankesExists);

                    })
                    ->default('')
                    ->selectablePlaceholder(false)
                    ->attribute('kode_fasyankes')

            ], layout: FiltersLayout::AboveContent)
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
            'index' => Pages\ManageOriImplementations::route('/'),
        ];
    }
}
