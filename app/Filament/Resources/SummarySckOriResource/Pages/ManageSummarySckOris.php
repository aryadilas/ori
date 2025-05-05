<?php

namespace App\Filament\Resources\SummarySckOriResource\Pages;

use App\Filament\Resources\SummarySckOriResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ManageSummarySckOris extends ManageRecords
{
    protected static string $resource = SummarySckOriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
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
