<?php

namespace App\Filament\Resources\Form2Resource\Pages;

use App\Filament\Resources\Form2Resource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageForm2s extends ManageRecords
{
    protected static string $resource = Form2Resource::class;

    protected ?string $subheading = 'Halaman untuk mengelola data form luas wilayah.';

    // protected function handleRecordCreation(array $data): Model
    // {
        // dd($data);
        // $userIds = $data["user_id"];
        // unset($data["user_id"]);

        // $models = [];

        // foreach ($userIds as $index => $userId) {
        //     $data['user_id'] = $userId;
        //     $model = static::getModel()::create($data);
        //     $models[] = $model;
        // }

        // return $models[0];
    // }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah')
                ->modalSubmitActionLabel('Tambah')
                ->createAnother(false)
                ->visible(auth()->user()->hasRole('Puskesmas'))
                ->modalHeading('Isi Data Form Luas Wilayah')
                ->successNotificationTitle('Berhasil tambah data.')
                ->mutateFormDataUsing(function (array $data): array {

                    $data['kode_fasyankes'] = auth()->user()->kode_fasyankes;
                    // $data['year'] = now()->format('Y');
                    
                    return $data;
                
                })
                ->action(function ($data){

                    // $records = [];
                    

                    // foreach ($data['Anggota Keluarga'] as $anggota) {

                    if ($data['house_id'] == 'new') {
                        $houseId = static::getModel()::where('year', $data['year'])->where('kode_fasyankes', auth()->user()->kode_fasyankes)->max('house_id') + 1;
                    } else {
                        $houseId = $data['house_id'];
                    }


                    return static::getModel()::create([
                        'house_id' => $houseId,
                        'kode_fasyankes' => $data['kode_fasyankes'],
                        'year' => $data['year'],
                        'village_name' => $data['village_name'],
                        'parent_nik' => $data['parent_nik'],
                        'parent_name' => $data['parent_name'],
                        'child_nik' => $data['child_nik'],
                        'child_name' => $data['child_name'],
                        'birthdate' => $data['birthdate'],
                        'gender' => $data['gender'],
                        'q1' => $data['q1'],
                        'q2' => $data['q2'],
                        'q3' => $data['q3'],
                        'q4' => $data['q4'],
                        'q5' => $data['q5'],
                        'q6' => $data['q6'],
                        'q7' => $data['q7'],
                        'q8' => $data['q8'],
                        'q9' => $data['q9'],
                    ]);

                    // }

                    // return $records[0];
                    
                }),
        ];
    }
}
