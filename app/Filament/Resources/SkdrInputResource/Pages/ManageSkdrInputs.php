<?php

namespace App\Filament\Resources\SkdrInputResource\Pages;

use App\Filament\Resources\SkdrInputResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSkdrInputs extends ManageRecords
{
    protected static string $resource = SkdrInputResource::class;

    protected ?string $subheading = 'Halaman untuk mengelola data SKDR.';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah')
                ->modalSubmitActionLabel('Tambah')
                ->createAnother(false)
                ->modalHeading('Tambah Data SKDR')
                ->successNotificationTitle('Berhasil tambah data.')
                ->mutateFormDataUsing(function (array $data): array {

                    $data['kode_fasyankes'] = auth()->user()->kode_fasyankes;
            
                    return $data;
                
                }),
        ];
    }
}
