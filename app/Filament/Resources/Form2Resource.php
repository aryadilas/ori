<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Form2Resource\Pages;
use App\Filament\Resources\Form2Resource\RelationManagers;
use App\Models\Form2Answer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\Form2ImunizedReason;
use App\Enums\ImunizedInformationSource;
use Illuminate\Support\HtmlString;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;

class Form2Resource extends Resource
{
    protected static ?string $model = Form2Answer::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'SCK ORI';

    protected static ?string $slug = 'sck-ori';

    protected static ?string $label = 'SCK ORI';

    protected static ?string $pluralModelLabel = 'SCK ORI';

    protected static ?string $navigationGroup = 'DATA';

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

                // Forms\Components\Repeater::make('Anggota Keluarga')
                //     ->itemLabel(fn (array $state): ?string => $state['child_name'] ?? null)
                //     ->AddActionLabel('Tambah anggota keluarga')
                //     ->collapsed()
                //     ->schema([

                Forms\Components\Select::make('year')
                    ->label('Tahun')
                    ->live()
                    ->default(now()->year)
                    ->options(function () {
                        $currentYear = now()->year;
                        $startYear = $currentYear - 2;
                        $endYear = $currentYear + 2;

                        $options = [];
                        for ($i = $startYear; $i <= $endYear; $i++) { 

                            $options[$i] = $i;

                        }

                        return $options;

                    })
                    ->inlineLabel()
                    ->required(),

                Forms\Components\Select::make('house_id')
                    ->label('Rumah')
                    ->options(function ($get) {

                        $existingHouseId = Form2Answer::select('house_id')->distinct()->where('year', $get('year'))->where('kode_fasyankes', auth()->user()->kode_fasyankes)->get()->pluck('house_id')->toArray();

                        $options = [];
                        $options['new'] = 'Tambah Rumah Baru';
                        foreach ($existingHouseId as $value) {
                            $options[$value] = $value;
                        }

                        return $options;

                    })
                    ->inlineLabel()
                    ->required(),

                Forms\Components\TextInput::make('parent_name')
                    ->label('Nama Orang Tua')
                    ->inlineLabel()
                    ->required(),
                Forms\Components\TextInput::make('child_name')
                    ->label('Nama Anak')
                    ->inlineLabel()
                    ->required(),
                Forms\Components\DatePicker::make('birthdate')
                    ->label('Tanggal Lahir')
                    ->inlineLabel()
                    ->required(),
                Forms\Components\Radio::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'l' => 'Laki - Laki',
                        'p' => 'Perempuan',
                    ])
                    ->required(),

                Forms\Components\Section::make('Status Imunisasi')
                    ->schema([
                        Forms\Components\Radio::make('q1')
                            ->label('1. Campak Rubela 1')
                            ->options([
                                'y' => 'Ya',
                                't' => 'Tidak',
                                'tt' => 'Tidak Tahu',
                                'n/a' => 'Not Applicable',
                            ])
                            ->required(),
                        Forms\Components\Radio::make('q2')
                            ->label('2. Campak Rubela 2')
                            ->options([
                                'y' => 'Ya',
                                't' => 'Tidak',
                                'tt' => 'Tidak Tahu',
                                'n/a' => 'Not Applicable',
                            ])
                            ->required(),
                        Forms\Components\Radio::make('q3')
                            ->label('3. Campak Rubela BIAS Kelas 1 SD/Sederajat')
                            ->options([
                                'y' => 'Ya',
                                't' => 'Tidak',
                                'tt' => 'Tidak Tahu',
                                'n/a' => 'Not Applicable',
                            ])
                            ->required(),
                        Forms\Components\Radio::make('q4')
                            ->label(fn (): HtmlString => new HtmlString(
                                '4. Imunisasi tambahan Campak Rubela<br> 
                                &nbsp;&nbsp; 1)  Kampanye 2017-2018<br>
                                &nbsp;&nbsp; 2) BIAN 2022<br>
                                &nbsp;&nbsp; 3) ORI<br>
                                &nbsp;&nbsp; 4) Lainnya'
                            ))
                            
                            ->options([
                                'y' => 'Ya',
                                't' => 'Tidak',
                                'tt' => 'Tidak Tahu',
                                'n/a' => 'Not Applicable',
                            ])
                            ->required(),
                    ]),
                    Forms\Components\Section::make('Alasan Tidak Diimunisasi')
                        ->schema([
                            Forms\Components\Select::make('q5')
                                ->label('5. Mengapa orang tua melewatkan satu atau lebih antigen, bahkan anak yang tidak mendapatkan imunisasi?')
                                ->options(Form2ImunizedReason::class),
                        ]),

                    Forms\Components\Radio::make('q6')
                        ->label('6. Apakah ayah mengizinkan anak untuk diimunisasi?')
                        ->options([
                            'y' => 'Ya',
                            't' => 'Tidak',
                        ])
                        ->required(),
                    Forms\Components\Select::make('q7')
                        ->label('7. Darimana Anda mendapatkan informasi tentang imunisasi?')
                        ->options(ImunizedInformationSource::class)
                        ->required(),
                    Forms\Components\Radio::make('q8')
                        ->label('8. Pada 14 hari terakhir apakah Bapak/Ibu pernah melihat anak yang demam dan ruam (bintik kemerahan)?')
                        ->options([
                            'y' => 'Ya',
                            't' => 'Tidak',
                        ])
                        ->required(),
                    Forms\Components\TextInput::make('q9')
                        ->label('9. Bila melihat anak dengan gejala tersebut mohon lengkapi dengan informasi nama dan alamat penderita.')
                        ->inlineLabel(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("fasyankes.name")
                    ->placeholder('-')
                    ->hidden(auth()->user()->hasRole('Puskesmas'))
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Puskesmas"),
                Tables\Columns\TextColumn::make("year")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Tahun"),
                Tables\Columns\TextColumn::make("house_id")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Rumah"),
                Tables\Columns\TextColumn::make("parent_name")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Nama Orang Tua"),
                Tables\Columns\TextColumn::make("child_name")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Nama Anak"),
                Tables\Columns\TextColumn::make("birthdate")
                    ->placeholder('-')
                    ->date('d F Y')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Tanggal Lahir"),
                Tables\Columns\TextColumn::make("monthAge")
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Usia (bulan)"),
                Tables\Columns\TextColumn::make("ageHelper")
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Tabel bantu usia 5 tahun (1) dan 6 tahun (2)"),
                Tables\Columns\TextColumn::make("ageCategory")
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Kategori Usia Anak"),
                Tables\Columns\TextColumn::make("birthYear")
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Tahun Lahir"),
                Tables\Columns\TextColumn::make("gender")
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->formatStateUsing(fn ($state) => $state == 'l' ? '1' : '2')
                    ->label("Jenis Kelamin"),
                Tables\Columns\TextColumn::make("q1")
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->formatStateUsing(fn ($state) => strtoupper($state) )
                    ->label("Campak Rubela 1"),
                Tables\Columns\TextColumn::make("rubela2Target")
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->formatStateUsing(fn ($state) => strtoupper($state) )
                    ->label("Sasaran Campak Rubela 2"),
                Tables\Columns\TextColumn::make("q2")
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->formatStateUsing(fn ($state) => strtoupper($state) )
                    ->label("Campak Rubela 2"),
                Tables\Columns\TextColumn::make("q3")
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->formatStateUsing(fn ($state) => strtoupper($state) )
                    ->label("Campak Rubela BIAS Kelas 1 SD/Sederajat"),
                Tables\Columns\TextColumn::make("q4")
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->formatStateUsing(fn ($state) => strtoupper($state) )
                    ->label("Imunisasi tambahan Campak Rubela"),
                Tables\Columns\TextColumn::make("q5")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Mengapa orang tua melewatkan satu atau lebih antigen, bahkan anak yang tidak mendapatkan imunisasi?"),
                Tables\Columns\TextColumn::make("q6")
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->formatStateUsing(fn ($state) => strtoupper($state) )
                    ->label("Apakah ayah mengizinkan anak untuk diimunisasi? "),
                Tables\Columns\TextColumn::make("q7")
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Darimana Anda mendapatkan informasi tentang imunisasi? "),
                Tables\Columns\TextColumn::make("q8")
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->formatStateUsing(fn ($state) => strtoupper($state) )
                    ->label("Pada 14 hari terakhir apakah Bapak/Ibu pernah melihat anak yang demam dan ruam (bintik kemerahan)?"),
                Tables\Columns\TextColumn::make("q9")
                    ->placeholder('-')
                    ->size(Tables\Columns\TextColumn\TextColumnSize::ExtraSmall)
                    ->label("Bila melihat anak dengan gejala tersebut mohon lengkapi dengan informasi nama dan alamat penderita."),
            ])
            ->filters([
                
                SelectFilter::make('year')
                    ->label('Tahun')
                    ->options(function () {
                        
                        $yearExists = static::getModel()::select('year')
                            ->when(auth()->user()->kode_fasyankes, function ($query) {
                                return $query->where('kode_fasyankes', auth()->user()->kode_fasyankes);
                            })
                            ->distinct()
                            ->get()
                            ->pluck('year');
                        
                        $options = [];

                        foreach ($yearExists as $value) {
                            $options[$value] = $value;
                        }

                        if (!$yearExists) {
                            $options[now()->year] = now()->year;
                            return $options;
                        }

                        return $options;

                    })
                    ->default(now()->year)
                    ->selectablePlaceholder(false)
                    ->attribute('year')

            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(auth()->user()->hasRole('Puskesmas'))
                    ->form([
                        Forms\Components\Select::make('house_id')
                            ->label('Rumah')
                            ->options(function ($record) {

                                $existingHouseId = Form2Answer::select('house_id')->distinct()->where('year', $record->year)->where('kode_fasyankes', auth()->user()->kode_fasyankes)->get()->pluck('house_id')->toArray();
                                // dd($options);
                                $options = [];
                                foreach ($existingHouseId as $value) {
                                    $options[$value] = $value;
                                }


                                return $options;


                            })
                            ->inlineLabel()
                            ->required(),

                        Forms\Components\TextInput::make('parent_name')
                            ->label('Nama Orang Tua')
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\TextInput::make('child_name')
                            ->label('Nama Anak')
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\DatePicker::make('birthdate')
                            ->label('Tanggal Lahir')
                            ->inlineLabel()
                            ->required(),
                        Forms\Components\Radio::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'l' => 'Laki - Laki',
                                'p' => 'Perempuan',
                            ])
                            ->required(),

                        Forms\Components\Section::make('Status Imunisasi')
                            ->schema([
                                Forms\Components\Radio::make('q1')
                                    ->label('1. Campak Rubela 1')
                                    ->options([
                                        'y' => 'Ya',
                                        't' => 'Tidak',
                                        'tt' => 'Tidak Tahu',
                                        'n/a' => 'Not Applicable',
                                    ])
                                    ->required(),
                                Forms\Components\Radio::make('q2')
                                    ->label('2. Campak Rubela 2')
                                    ->options([
                                        'y' => 'Ya',
                                        't' => 'Tidak',
                                        'tt' => 'Tidak Tahu',
                                        'n/a' => 'Not Applicable',
                                    ])
                                    ->required(),
                                Forms\Components\Radio::make('q3')
                                    ->label('3. Campak Rubela BIAS Kelas 1 SD/Sederajat')
                                    ->options([
                                        'y' => 'Ya',
                                        't' => 'Tidak',
                                        'tt' => 'Tidak Tahu',
                                        'n/a' => 'Not Applicable',
                                    ])
                                    ->required(),
                                Forms\Components\Radio::make('q4')
                                    ->label(fn (): HtmlString => new HtmlString(
                                        '4. Imunisasi tambahan Campak Rubela<br> 
                                        &nbsp;&nbsp; 1)  Kampanye 2017-2018<br>
                                        &nbsp;&nbsp; 2) BIAN 2022<br>
                                        &nbsp;&nbsp; 3) ORI<br>
                                        &nbsp;&nbsp; 4) Lainnya'
                                    ))
                                    
                                    ->options([
                                        'y' => 'Ya',
                                        't' => 'Tidak',
                                        'tt' => 'Tidak Tahu',
                                        'n/a' => 'Not Applicable',
                                    ])
                                    ->required(),
                            ]),
                            Forms\Components\Section::make('Alasan Tidak Diimunisasi')
                                ->schema([
                                    Forms\Components\Select::make('q5')
                                        ->label('5. Mengapa orang tua melewatkan satu atau lebih antigen, bahkan anak yang tidak mendapatkan imunisasi?')
                                        ->options(Form2ImunizedReason::class)
                                        ,
                                ]),

                            Forms\Components\Radio::make('q6')
                                ->label('6. Apakah ayah mengizinkan anak untuk diimunisasi?')
                                ->options([
                                    'y' => 'Ya',
                                    't' => 'Tidak',
                                ])
                                ->required(),
                            Forms\Components\Select::make('q7')
                                ->label('7. Darimana Anda mendapatkan informasi tentang imunisasi?')
                                ->options(ImunizedInformationSource::class)
                                ->required(),
                            Forms\Components\Radio::make('q8')
                                ->label('8. Pada 14 hari terakhir apakah Bapak/Ibu pernah melihat anak yang demam dan ruam (bintik kemerahan)?')
                                ->options([
                                    'y' => 'Ya',
                                    't' => 'Tidak',
                                ])
                                ->required(),
                            Forms\Components\TextInput::make('q9')
                                ->label('9. Bila melihat anak dengan gejala tersebut mohon lengkapi dengan informasi nama dan alamat penderita.')
                                ->inlineLabel(),
                    ]),
                    // ->mutateFormDataUsing(function (array $data): array {

                        // if ($data['house_id'] == 'new') {
                        //     $data['house_id'] = parent::getModel()::where('year', $data['year'])->where('kode_fasyankes', auth()->user()->kode_fasyankes)->max('house_id') + 1;
                        // } 
                        
                        // return $data;
                    
                    // }),
                Tables\Actions\DeleteAction::make()
                    ->visible(auth()->user()->hasRole('Puskesmas')),
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
            'index' => Pages\ManageForm2s::route('/'),
        ];
    }
}
