<?php

namespace App\Filament\Resources\SkdrResource\Pages;

use App\Filament\Resources\SkdrResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSkdrs extends ManageRecords
{
    protected static string $resource = SkdrResource::class;

    protected ?string $subheading = 'Halaman untuk melihat data SKDR.';

    protected function getHeaderActions(): array
    {
        return [];
    }
}



