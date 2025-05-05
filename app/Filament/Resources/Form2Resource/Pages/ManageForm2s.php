<?php

namespace App\Filament\Resources\Form2Resource\Pages;

use App\Filament\Resources\Form2Resource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ManageForm2s extends ManageRecords
{
    protected static string $resource = Form2Resource::class;

    protected ?string $subheading = 'Halaman untuk mengelola data form luas wilayah.';

    // protected function handleRecordCreation(array $data): Model
    // {
        // dd($data);
        // $userIds = $data["user_id"];
        // unset($data["user_id"]);

        // $models = [];

        // foreach ($userIds as $index => $userId) {
        //     $data['user_id'] = $userId;
        //     $model = static::getModel()::create($data);
        //     $models[] = $model;
        // }

        // return $models[0];
    // }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah')
                ->modalSubmitActionLabel('Tambah')
                ->createAnother(false)
                ->visible(auth()->user()->hasRole('Puskesmas'))
                ->modalHeading('Isi Data Form Luas Wilayah')
                ->successNotificationTitle('Berhasil tambah data.')
                ->mutateFormDataUsing(function (array $data): array {

                    $data['kode_fasyankes'] = auth()->user()->kode_fasyankes;
                    // $data['year'] = now()->format('Y');
                    
                    return $data;
                
                })
                ->action(function ($data){

                    // $records = [];
                    

                    // foreach ($data['Anggota Keluarga'] as $anggota) {

                    if ($data['house_id'] == 'new') {
                        $houseId = static::getModel()::where('year', $data['year'])->where('kode_fasyankes', auth()->user()->kode_fasyankes)->max('house_id') + 1;
                    } else {
                        $houseId = $data['house_id'];
                    }


                    return static::getModel()::create([
                        'house_id' => $houseId,
                        'kode_fasyankes' => $data['kode_fasyankes'],
                        'year' => $data['year'],
                        'village_name' => $data['village_name'],
                        'parent_nik' => $data['parent_nik'],
                        'parent_name' => $data['parent_name'],
                        'child_nik' => $data['child_nik'],
                        'child_name' => $data['child_name'],
                        'birthdate' => $data['birthdate'],
                        'gender' => $data['gender'],
                        'q1' => $data['q1'],
                        'q2' => $data['q2'],
                        'q3' => $data['q3'],
                        'q4' => $data['q4'],
                        'q5' => $data['q5'],
                        'q6' => $data['q6'],
                        'q7' => $data['q7'],
                        'q8' => $data['q8'],
                        'q9' => $data['q9'],
                    ]);

                    // }

                    // return $records[0];
                    
                }),
            ImportAction::make()
                ->visible(auth()->user()->hasRole('Puskesmas'))
                ->fields([

                    ImportField::make('tahun')
                        ->required(),
                    ImportField::make('nama_kelurahan')
                        ->required(),
                    ImportField::make('id_rumah')
                        ->required(),
                    ImportField::make('nik_orangtua')
                        ->required(),
                    ImportField::make('nama_orangtua')
                        ->required(),
                    ImportField::make('nik_anak')
                        ->required(),
                    ImportField::make('nama_anak')
                        ->required(),
                    ImportField::make('tgl_lahir_anak')
                        ->required(),
                    ImportField::make('jenis_kelamin_anak')
                        ->required(),
                    ImportField::make('status_imunisasi_anak_cr1')
                        ->required(),
                    ImportField::make('status_imunisasi_anak_cr2')
                        ->required(),
                    ImportField::make('status_imunisasi_anak_cr_bias')
                        ->required(),
                    ImportField::make('status_imunisasi_anak_cr_tambahan')
                        ->required(),
                    ImportField::make('alasan_tidak_imunisasi')
                        ->required(),
                    ImportField::make('izin_orangtua_imunisasi')
                        ->required(),
                    ImportField::make('asal_informasi')
                        ->required(),
                    ImportField::make('demam_ruam_14hari')
                        ->required(),
                    ImportField::make('ruam_informasi_nama_alamat')
                        ->required(),
                    
                ])
                ->handleRecordCreation(function(array $data) { 

                    return static::getModel()::create([
                        'kode_fasyankes' => auth()->user()->kode_fasyankes,
                        'house_id' => $data['id_rumah'],
                        'village_name' => $data['nama_kelurahan'],
                        'year' => $data['tahun'],
                        'parent_nik' => $data['nik_orangtua'],
                        'parent_name' => $data['nama_orangtua'],
                        'child_nik' => $data['nik_anak'],
                        'child_name' => $data['nama_anak'],
                        'birthdate' => $data['tgl_lahir_anak'],
                        'gender' => $data['jenis_kelamin_anak'],
                        'q1' => $data['status_imunisasi_anak_cr1'],
                        'q2' => $data['status_imunisasi_anak_cr2'],
                        'q3' => $data['status_imunisasi_anak_cr_bias'],
                        'q4' => $data['status_imunisasi_anak_cr_tambahan'],
                        'q5' => $data['alasan_tidak_imunisasi'],
                        'q6' => $data['izin_orangtua_imunisasi'],
                        'q7' => $data['asal_informasi'],
                        'q8' => $data['demam_ruam_14hari'],
                        'q9' => $data['ruam_informasi_nama_alamat'],
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
    }
}
