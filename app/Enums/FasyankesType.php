<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum FasyankesType: string implements HasLabel 
{
    case PUSKESMAS = 'Puskesmas';
    case RS = 'RS';
    case LAB = 'Lab';
    case KLINIK = 'Klinik';

    public function getLabel(): ?string
    {
    
        return match ($this) {

            self::PUSKESMAS => 'Puskesmas',
            self::RS => 'RS',
            self::LAB => 'Lab',
            self::KLINIK => 'Klinik',

        };
        
    }
}
