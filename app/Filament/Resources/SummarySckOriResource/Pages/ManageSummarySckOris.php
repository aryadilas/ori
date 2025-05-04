<?php

namespace App\Filament\Resources\SummarySckOriResource\Pages;

use App\Filament\Resources\SummarySckOriResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSummarySckOris extends ManageRecords
{
    protected static string $resource = SummarySckOriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
