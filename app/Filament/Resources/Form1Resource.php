<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Form1Resource\Pages;
use App\Filament\Resources\Form1Resource\RelationManagers;
use App\Models\Form1Answer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class Form1Resource extends Resource
{
    protected static ?string $model = Form1Answer::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Luas Wilayah';

    protected static ?string $slug = 'luas-wilayah';

    protected static ?string $label = 'Luas Wilayah';

    protected static ?string $pluralModelLabel = 'Luas Wilayah';

    protected static ?string $navigationGroup = 'DATA';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                
                Forms\Components\TextInput::make('village_name')
                    ->label('Desa/Kelurahan')
                    ->inlineLabel()
                    ->required(),

                Forms\Components\Radio::make('q1')
                    ->label('1. Sedang terjadi KLB campak/rubela/mix (Y/T)')
                    ->options([
                        'y' => 'Y',
                        't' => 'T',
                    ])
                    ->required(),
                Forms\Components\Radio::make('q2')
                    ->label('2. Adanya mobilitas penduduk dari dan ke wilayah KLB (Y/T)')
                    ->options([
                        'y' => 'Y',
                        't' => 'T',
                    ])
                    ->required(),

                Forms\Components\Section::make('3. Campak Rubela 1')
                    ->schema([
                        Forms\Components\TextInput::make('q3a')
                            ->label('3A. Jumlah tahun arsip data tersedia (3 s/d 5 tahun terakhir)')
                            ->inlineLabel()
                            ->numeric()
                            ->live()
                            ->required(),
                        Forms\Components\TextInput::make('q3b')
                            ->label('3B. Jumlah kumulatif cakupan imunisasi (%)')
                            ->inlineLabel()
                            ->numeric()
                            ->maxValue(fn ($get) => $get('q3a') * 100)
                            ->required(),        
                    ]),

                Forms\Components\Section::make('4. Campak Rubela 2')
                    ->schema([
                        Forms\Components\TextInput::make('q4a')
                            ->label('4A. Jumlah tahun arsip data tersedia (3 s/d 5 tahun terakhir)')
                            ->inlineLabel()
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('q4b')
                            ->label('4B. Jumlah kumulatif cakupan imunisasi (%)')
                            ->inlineLabel()
                            ->numeric()
                            ->required(),
                    ]),

                Forms\Components\Section::make('5. Campak Rubela BIAS (Kelas 1 SD/Sederajat)')
                    ->schema([
                        Forms\Components\TextInput::make('q5a')
                            ->label('5A. Jumlah tahun arsip data tersedia (3 s/d 5 tahun terakhir)')
                            ->inlineLabel()
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('q5b')
                            ->label('5B. Jumlah kumulatif cakupan imunisasi (%)')
                            ->inlineLabel()
                            ->numeric()
                            ->required(),
                    ]),

                Forms\Components\Section::make('6. Campak Rubela Tambahan (BIAN/kampanye/ORI)')
                    ->schema([
                        Forms\Components\TextInput::make('q6a')
                            ->label('6A. Berapa tahun arsip data tersedia?')
                            ->inlineLabel()
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('q6b')
                            ->label('6B. Jumlah kumulatif cakupan imunisasi (%)')
                            ->inlineLabel()
                            ->numeric()
                            ->required(),
                    ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("village_name")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Desa/Kelurahan"),
                Tables\Columns\TextColumn::make("summary")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Kesimpulan")
            ])
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
            'index' => Pages\ManageForm1s::route('/'),
        ];
    }
}
