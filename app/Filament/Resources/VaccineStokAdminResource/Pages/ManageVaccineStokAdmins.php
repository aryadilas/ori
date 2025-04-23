<?php

namespace App\Filament\Resources\VaccineStokAdminResource\Pages;

use App\Filament\Resources\VaccineStokAdminResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVaccineStokAdmins extends ManageRecords
{
    protected static string $resource = VaccineStokAdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
