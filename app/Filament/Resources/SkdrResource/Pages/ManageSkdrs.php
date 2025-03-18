<?php

namespace App\Filament\Resources\SkdrResource\Pages;

use App\Filament\Resources\SkdrResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSkdrs extends ManageRecords
{
    protected static string $resource = SkdrResource::class;

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
                    // if ( auth()->user()->hasRole('Admin') ) {
                    //     $data['opd_id'] = auth()->user()->opd_id;
                    // }
            
                    return $data;
                
                }),
        ];
    }
}



