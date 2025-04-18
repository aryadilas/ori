<?php

namespace App\Filament\Resources\VaccineStokResource\Pages;

use App\Filament\Resources\VaccineStokResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVaccineStoks extends ManageRecords
{
    protected static string $resource = VaccineStokResource::class;

    protected ?string $subheading = 'Halaman untuk mengelola data Vaksin.';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah')
                ->modalSubmitActionLabel('Tambah')
                ->createAnother(false)
                ->modalHeading('Tambah Data Vaksin')
                ->successNotificationTitle('Berhasil tambah data.'),
        ];
    }
}
