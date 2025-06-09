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

    protected ?string $subheading = 'Halaman untuk mengetahui ketepatan waktu Pelaksanaan ORI Campak-Rubela.';

    protected static ?string $navigationGroup = 'INPUT KAJIAN EPIDEMIOLOGI';

    protected static ?int $navigationSort = 5;

    public $notifications = [];
    public $implementation_date = [];

    public function mount()
    {

        $notifications = Notification::with('fasyankes')->where('status', 'confirmed');
        if (auth()->user()->hasRole('Puskesmas')) {
            $notifications->where('kode_fasyankes', auth()->user()->kode_fasyankes);
        }

        $this->notifications = $notifications->get();
        
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
