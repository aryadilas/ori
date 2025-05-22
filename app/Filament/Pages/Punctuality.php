<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Notification;

class Punctuality extends Page
{

    protected static string $view = 'filament.pages.punctuality';

    protected static ?string $title = 'Ketepatan Waktu';

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationLabel = 'Ketepatan Waktu';

    protected ?string $heading = 'Ketepatan Waktu';

    protected ?string $subheading = 'Halaman untuk mengolah data ketepatan waktu.';

    protected static ?string $navigationGroup = 'ORI KLB CAMPAK-RUBELA';

    protected static ?int $navigationSort = 5;

    public $notifications = [];
    public $implementation_date = [];

    public function mount()
    {

        $this->notifications = Notification::with('fasyankes')->where('kode_fasyankes', auth()->user()->kode_fasyankes)->where('status', 'confirmed')->get();
        $this->implementation_date = $this->notifications
            ->mapWithKeys(fn ($notif) => [
                $notif->id => $notif->implementation_date,
            ])
            ->toArray();                

    }

    public function updateImplementationDate($notification_id, $implementation_date)
    {

        $this->notifications->where('id', $notification_id)->first()->update([
            'implementation_date' => $implementation_date
        ]);

    }

}
