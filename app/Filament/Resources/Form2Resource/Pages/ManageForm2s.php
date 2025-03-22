<?php

namespace App\Filament\Resources\Form2Resource\Pages;

use App\Filament\Resources\Form2Resource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageForm2s extends ManageRecords
{
    protected static string $resource = Form2Resource::class;

    protected function handleRecordCreation(array $data): Model
    {
        dd($data);
        // $userIds = $data["user_id"];
        // unset($data["user_id"]);

        // $models = [];

        // foreach ($userIds as $index => $userId) {
        //     $data['user_id'] = $userId;
        //     $model = static::getModel()::create($data);
        //     $models[] = $model;
        // }

        // return $models[0];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah')
                ->modalSubmitActionLabel('Tambah')
                ->createAnother(false)
                ->modalHeading('Isi Data Form Luas Wilayah')
                ->successNotificationTitle('Berhasil tambah data.')
                ->mutateFormDataUsing(function (array $data): array {

                    $data['kode_fasyankes'] = auth()->user()->kode_fasyankes;
                    $data['year'] = now()->format('Y');

                    // dd($data);

                    // foreach ($data['Anggota Keluarga'] as $key => $value) {
                        
                        

                    // }
                    
                    return $data;
                
                })
                ->action(function ($data){

                    $records = [];
                    $lastHouseId = static::getModel()::max('house_id') + 1;

                    foreach ($data['Anggota Keluarga'] as $anggota) {


                        $records[] = static::getModel()::create([
                            'house_id' => $lastHouseId,
                            'kode_fasyankes' => $data['kode_fasyankes'],
                            'year' => $data['year'],
                            'parent_name' => $anggota['parent_name'],
                            'child_name' => $anggota['child_name'],
                            'birthdate' => $anggota['birthdate'],
                            'gender' => $anggota['gender'],
                            'q1' => $anggota['q1'],
                            'q2' => $anggota['q2'],
                            'q3' => $anggota['q3'],
                            'q4' => $anggota['q4'],
                            'q5' => $anggota['q5'],
                            'q6' => $anggota['q6'],
                            'q7' => $anggota['q7'],
                            'q8' => $anggota['q8'],
                            'q9' => $anggota['q9'],
                        ]);

                    }

                    return $records[0];
                    
                }),
        ];
    }
}
