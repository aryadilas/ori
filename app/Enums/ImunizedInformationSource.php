<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum ImunizedInformationSource: string implements HasLabel 
{

    case OP1 = 'Anggota keluarga';
    case OP2 = 'Tetangga';
    case OP3 = 'Kader';
    case OP4 = 'Bidan/Perawat/Dokter/Dokter SpA (tenaga kesehatan)';
    case OP5 = 'Tokoh Agama';
    case OP6 = 'Ketua RT/Kepala Desa (Tokoh Masyarakat)';
    case OP7 = 'Ibu-ibu PKK';
    case OP8 = 'Pengumuman dari tempat ibadah';
    case OP9 = 'Guru';
    case OP10 = 'Interactive online chat (contoh Halo Doc)';
    case OP11 = 'Media Sosial';
    case OP12 = 'Media elektronik (TV/radio)';

    public function getLabel(): ?string
    {

        return match ($this) {

            self::OP1 => 'Anggota keluarga',
            self::OP2 => 'Tetangga',
            self::OP3 => 'Kader',
            self::OP4 => 'Bidan/Perawat/Dokter/Dokter SpA (tenaga kesehatan)',
            self::OP5 => 'Tokoh Agama',
            self::OP6 => 'Ketua RT/Kepala Desa (Tokoh Masyarakat)',
            self::OP7 => 'Ibu-ibu PKK',
            self::OP8 => 'Pengumuman dari tempat ibadah',
            self::OP9 => 'Guru',
            self::OP10 => 'Interactive online chat (contoh Halo Doc)',
            self::OP11 => 'Media Sosial',
            self::OP12 => 'Media elektronik (TV/radio)',

        };

    }

}
