<?php

namespace App\Filament\Pages;

use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends \Filament\Pages\Dashboard
{

    protected static string $view = 'filament.pages.dashboard';

    protected static ?string $title = '';

    protected static ?string $navigationLabel = 'Dashboard';
    

    public function getColumns(): int | string | array
    {
        return 3;
    }

}