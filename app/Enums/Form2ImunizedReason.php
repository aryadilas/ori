<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum Form2ImunizedReason: string implements HasLabel 
{
    
    case OP1 = 'Merasa tidak butuh';
    case OP2 = 'Tidak mengetahui tempat, jadwal dan dosis yang belum lengkap';
    case OP3 = 'Orang tua/pengasuh bekerja';
    case OP4 = 'Anak sakit';
    case OP5 = 'Takut disuntik';
    case OP6 = 'Takut imunisasi ganda';
    case OP7 = 'Anggota keluarga menolak/tidak mengizinkan mengimunisasikan anak';
    case OP8 = 'Riwayat KIPI (sakit ringan, demam, nyeri, pembengkakan, dll)';
    case OP9 = 'Hoax';
    case OP10 = 'Tidak ada pelayanan imunisasi di sekitar lingkungan tempat tinggal/jauh';
    case OP11 = 'Vaksin tidak tersedia';
    case OP12 = 'Alasan medis tertentu (pengobatan steroid, immunocompromised, kelainan bawaan/congenital)';
    case OP13 = 'Alasan adat istiadat/keyakinan';

    public function getLabel(): ?string
    {
    
        return match ($this) {

            self::OP1 => 'Merasa tidak butuh',
            self::OP2 => 'Tidak mengetahui tempat, jadwal dan dosis yang belum lengkap',
            self::OP3 => 'Orang tua/pengasuh bekerja',
            self::OP4 => 'Anak sakit',
            self::OP5 => 'Takut disuntik',
            self::OP6 => 'Takut imunisasi ganda',
            self::OP7 => 'Anggota keluarga menolak/tidak mengizinkan mengimunisasikan anak',
            self::OP8 => 'Riwayat KIPI (sakit ringan, demam, nyeri, pembengkakan, dll)',
            self::OP9 => 'Hoax',
            self::OP10 => 'Tidak ada pelayanan imunisasi di sekitar lingkungan tempat tinggal/jauh',
            self::OP11 => 'Vaksin tidak tersedia',
            self::OP12 => 'Alasan medis tertentu (pengobatan steroid, immunocompromised, kelainan bawaan/congenital)',
            self::OP13 => 'Alasan adat istiadat/keyakinan',

        };
        
    }


}
