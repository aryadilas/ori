<?php

namespace App\Filament\Resources\Form3Resource\Pages;

use App\Filament\Resources\Form3Resource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ManageForm3s extends ManageRecords
{
    protected static string $resource = Form3Resource::class;

    protected ?string $subheading = 'Halaman untuk mengelola data form kelompok usia.';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah')
                ->modalSubmitActionLabel('Tambah')
                ->createAnother(false)
                ->visible(auth()->user()->hasRole('Puskesmas'))
                ->modalHeading('Isi Data Form Kelompok Usia')
                ->successNotificationTitle('Berhasil tambah data.')
                ->action(function ($data){

                    $age9to18month = [
                        'kode_fasyankes' => auth()->user()->kode_fasyankes,
                        'year' => $data['year'],
                        'village_name' => $data['village_name'],
                        'age_group' => '9 - <18 bulan',
                        'suspect' => $data['suspect_9to18month'],
                        'population' => $data['population_9to18month'],
                    ];
                    static::getModel()::create($age9to18month);

                    $age18to59month = [
                        'kode_fasyankes' => auth()->user()->kode_fasyankes,
                        'year' => $data['year'],
                        'village_name' => $data['village_name'],
                        'age_group' => '18 - 59 bulan',
                        'suspect' => $data['suspect_18to59month'],
                        'population' => $data['population_18to59month'],
                    ];
                    static::getModel()::create($age18to59month);

                    $age5to7year = [
                        'kode_fasyankes' => auth()->user()->kode_fasyankes,
                        'year' => $data['year'],
                        'village_name' => $data['village_name'],
                        'age_group' => '5 - <7 tahun',
                        'suspect' => $data['suspect_5to7year'],
                        'population' => $data['population_5to7year'],
                    ];
                    static::getModel()::create($age5to7year);

                    $age7to13year = [
                        'kode_fasyankes' => auth()->user()->kode_fasyankes,
                        'year' => $data['year'],
                        'village_name' => $data['village_name'],
                        'age_group' => '7 - <13 tahun',
                        'suspect' => $data['suspect_7to13year'],
                        'population' => $data['population_7to13year'],
                    ];
                    static::getModel()::create($age7to13year);

                    $age13to16year = [
                        'kode_fasyankes' => auth()->user()->kode_fasyankes,
                        'year' => $data['year'],
                        'village_name' => $data['village_name'],
                        'age_group' => '13 - <16 tahun',
                        'suspect' => $data['suspect_13to16year'],
                        'population' => $data['population_13to16year'],
                    ];
                    static::getModel()::create($age13to16year);

                    $more16year = [
                        'kode_fasyankes' => auth()->user()->kode_fasyankes,
                        'year' => $data['year'],
                        'village_name' => $data['village_name'],
                        'age_group' => '≥ 16 tahun',
                        'suspect' => $data['suspect_more16year'],
                        'population' => $data['population_more16year'],
                    ];
                    $return = static::getModel()::create($more16year);

                    return $return;
                }),
            ImportAction::make()
                ->visible(auth()->user()->hasRole('Puskesmas'))
                ->fields([

                    ImportField::make('kelompok_usia')
                        ->required(),
                    ImportField::make('tahun')
                        ->required(),
                    ImportField::make('nama_kelurahan')
                        ->required(),
                    ImportField::make('jumlah_kasus')
                        ->required(),
                    ImportField::make('populasi')
                        ->required(),
                    
                    
                ])
                ->handleRecordCreation(function(array $data) { 

                    return static::getModel()::create([
                        'kode_fasyankes' => auth()->user()->kode_fasyankes,
                        'year' => $data['tahun'],
                        'age_group' => $data['kelompok_usia'],
                        'suspect' => $data['jumlah_kasus'],
                        'population' => $data['populasi'],
                        'village_name' => $data['nama_kelurahan'],
                    ]);

                }),

            ExportAction::make() 
                ->hidden(auth()->user()->hasRole('Puskesmas'))
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->withFilename(fn ($resource) => $resource::getModelLabel() . '-' . date('Y-m-d'))
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                ]), 
        ];
        // static::getModel()::create($more16year);
        // ;
    }
}
