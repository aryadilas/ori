<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Fasyankes;
use App\Models\Vaccine;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vaccine>
 */
class VaccineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Vaccine::class;

    // public function definition(): array
    // {
    //     // Ambil kode fasyankes secara acak
    //     $kode_fasyankes = Fasyankes::inRandomOrder()->first()->kode_fasyankes;

    //     // Ambil semua tanggal yang sudah ada untuk kode_fasyankes ini
    //     $existingDates = Vaccine::where('kode_fasyankes', $kode_fasyankes)->pluck('date')->toArray();

    //     // Menghasilkan tanggal acak yang unik
    //     do {
    //         $date = $this->faker->dateTimeBetween('2025-01-01', '2025-12-31')->format('Y-m-d');
    //     } while (in_array($date, $existingDates)); // Periksa apakah tanggal sudah ada

    //     return [
    //         'date' => $date,
    //         'category' => $this->faker->randomElement(['penambahan', 'pengurangan']), // Enum
    //         'amount' => $this->faker->numberBetween(25, 80), // Jumlah 25-80
    //         'kode_fasyankes' => $kode_fasyankes, // Pilih random dari tabel fasyankes
    //     ];
    // }

    public function definition(): array
    {
        // Ambil kode fasyankes secara acak
        $kode_fasyankes = Fasyankes::inRandomOrder()->first()->kode_fasyankes;

        // Hitung total stok saat ini untuk kode_fasyankes ini
        $currentStock = Vaccine::where('kode_fasyankes', $kode_fasyankes)
            ->where('category', 'penambahan')
            ->sum('amount') - Vaccine::where('kode_fasyankes', $kode_fasyankes)
            ->where('category', 'pengurangan')
            ->sum('amount');

        // Tentukan jumlah yang akan ditambahkan atau dikurangi
        $amount = $this->faker->numberBetween(25, 80);

        // Pastikan stok tidak menjadi negatif
        if ($currentStock < $amount && $this->faker->boolean(50)) {
            // Jika stok tidak cukup, set kategori ke 'penambahan' dan amount ke 0
            return [
                'date' => $this->faker->dateTimeBetween('2025-01-01', '2025-12-31')->format('Y-m-d'),
                'category' => 'penambahan',
                'amount' => 0, // Tidak menambah stok
                'kode_fasyankes' => $kode_fasyankes,
            ];
        }

        // Pilih kategori secara acak
        $category = $this->faker->randomElement(['penambahan', 'pengurangan']);

        return [
            'date' => $this->faker->dateTimeBetween('2025-01-01', '2025-12-31')->format('Y-m-d'),
            'category' => $category,
            'amount' => $category === 'penambahan' ? $amount : min($amount, $currentStock), // Pastikan tidak lebih dari stok yang ada
            'kode_fasyankes' => $kode_fasyankes,
        ];
    }




}
