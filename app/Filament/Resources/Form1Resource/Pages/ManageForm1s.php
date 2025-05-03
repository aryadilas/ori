<?php

namespace App\Filament\Resources\Form1Resource\Pages;

use App\Filament\Resources\Form1Resource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;

class ManageForm1s extends ManageRecords
{
    protected static string $resource = Form1Resource::class;

    protected ?string $subheading = 'Halaman untuk mengelola data form luas wilayah.';

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

                    // dd($data);
                    // if ( auth()->user()->hasRole('Admin') ) {
                    //     $data['opd_id'] = auth()->user()->opd_id;
                    // }
            
                    return $data;
                
                }),
            ImportAction::make()
                ->visible(auth()->user()->hasRole('Puskesmas'))
                ->fields([
                    // ImportField::make('kode_fasyankes')
                    //     ->required(),
                    ImportField::make('nama_kelurahan')
                        ->required(),
                    ImportField::make('tahun')
                        ->required(),
                    ImportField::make('status_klb')
                        ->required(),
                    ImportField::make('mobilitas_penduduk_klb')
                        ->required(),
                    ImportField::make('tahun_arsip_tersedia_cr1')
                        ->required(),
                    ImportField::make('cakupan_imunisasi_kumulatif_cr1')
                        ->required(),
                    ImportField::make('tahun_arsip_tersedia_cr2')
                        ->required(),
                    ImportField::make('cakupan_imunisasi_kumulatif_cr2')
                        ->required(),
                    ImportField::make('tahun_arsip_tersedia_cr_bias')
                        ->required(),
                    ImportField::make('cakupan_imunisasi_kumulatif_cr_bias')
                        ->required(),
                    ImportField::make('tahun_arsip_tersedia_cr_tambahan')
                        ->required(),
                    ImportField::make('cakupan_imunisasi_kumulatif_cr_tambahan')
                        ->required(),
                ])
                ->handleRecordCreation(function(array $data) { 

                    return static::getModel()::create([
                        'kode_fasyankes' => auth()->user()->kode_fasyankes,
                        'village_name' => $data['nama_kelurahan'],
                        'year' => $data['tahun'],
                        'q1' => $data['status_klb'],
                        'q2' => $data['mobilitas_penduduk_klb'],
                        'q3a' => $data['tahun_arsip_tersedia_cr1'],
                        'q3b' => $data['cakupan_imunisasi_kumulatif_cr1'],
                        'q4a' => $data['tahun_arsip_tersedia_cr2'],
                        'q4b' => $data['cakupan_imunisasi_kumulatif_cr2'],
                        'q5a' => $data['tahun_arsip_tersedia_cr_bias'],
                        'q5b' => $data['cakupan_imunisasi_kumulatif_cr_bias'],
                        'q6a' => $data['tahun_arsip_tersedia_cr_tambahan'],
                        'q6b' => $data['cakupan_imunisasi_kumulatif_cr_tambahan'],
                    ]);

                }),
        ];
    }
}