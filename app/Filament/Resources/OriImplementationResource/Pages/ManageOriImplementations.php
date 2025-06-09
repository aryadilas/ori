<?php

namespace App\Filament\Resources\OriImplementationResource\Pages;

use App\Filament\Resources\OriImplementationResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class ManageOriImplementations extends ManageRecords
{
    protected static string $resource = OriImplementationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah')
                ->modalSubmitActionLabel('Tambah')
                ->createAnother(false)
                ->visible(auth()->user()->hasRole('Puskesmas'))
                ->modalHeading('Isi Data Pelaksanaan ORI')
                ->successNotificationTitle('Berhasil tambah data.')
                ->mutateFormDataUsing(function (array $data): array {

                    $data['kode_fasyankes'] = auth()->user()->kode_fasyankes;
                    // $data['year'] = now()->format('Y');
                    
                    return $data;
                
                }),
            ImportAction::make()
                ->visible(auth()->user()->hasRole('Puskesmas'))
                ->fields([

                    ImportField::make('kelurahan')
                        ->required(),
                    ImportField::make('nama_anak')
                        ->required(),
                    ImportField::make('tgl_lahir')
                        ->required(),
                    ImportField::make('jenis_kelamin')
                        ->required(),
                    ImportField::make('nik_anak')
                        ->required(),
                    ImportField::make('nama_orangtua')
                        ->required(),
                    ImportField::make('nik_orangtua')
                        ->required(),
                    ImportField::make('alamat')
                        ->required(),
                    ImportField::make('no_hp')
                        ->required(),
                    ImportField::make('status_kehadiran')
                        ->required(),
                    
                    
                ])
                ->handleRecordCreation(function(array $data) { 
                    $tgl_lahir = Carbon::parse($data['tgl_lahir'])->format('Y-m-d');

                    return static::getModel()::create([
                        'kode_fasyankes' => auth()->user()->kode_fasyankes,
                        'village_name' => $data['kelurahan'],
                        'child_name' => $data['nama_anak'],
                        'birthday' => $tgl_lahir,
                        'gender' => $data['jenis_kelamin'],
                        'child_nik' => $data['nik_anak'],
                        'parent_name' => $data['nama_orangtua'],
                        'parent_nik' => $data['nik_orangtua'],
                        'address' => $data['alamat'],
                        'telp' => $data['no_hp'],
                        'status' => $data['status_kehadiran'],
                    ]);

                }),
        ];
    }
}
