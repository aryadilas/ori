<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Facades\Filament;

class NotificationAlert extends Page
{

    protected static string $view = 'filament.pages.notification-alert';

    protected static ?string $title = 'Notification Alert';

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';


    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return Filament::getWidgets();
    }

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    public function getVisibleWidgets(): array
    {
        return $this->filterVisibleWidgets($this->getWidgets());
    }

    /**
     * @return int | string | array<string, int | string | null>
     */
    public function getColumns(): int | string | array
    {
        return 3;
    }

}
