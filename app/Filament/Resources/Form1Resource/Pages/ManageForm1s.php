<?php

namespace App\Filament\Resources\Form1Resource\Pages;

use App\Filament\Resources\Form1Resource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

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
                ->modalHeading('Isi Data Form Luas Wilayah')
                ->successNotificationTitle('Berhasil tambah data.')
                ->mutateFormDataUsing(function (array $data): array {

                    $data['kode_fasyankes'] = auth()->user()->kode_fasyankes;
                    $data['year'] = now()->format('Y');

                    // dd($data);
                    // if ( auth()->user()->hasRole('Admin') ) {
                    //     $data['opd_id'] = auth()->user()->opd_id;
                    // }
            
                    return $data;
                
                }),
        ];
    }
}
