<?php

namespace App\Imports;

use App\Models\Data;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class DataImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach  ($rows as $row) {
            $user = User::firstOrCreate([
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
            ], [
                'role' => $row['role'] ?? 'member',
                'verify' => $row['verify'] ?? false,  
                'password' => Hash::make('password'),
            ]);

            Data::create([
                'user_id' => $user->id,
                // 'alamat' => $row['alamat'],
                'lokasi' => $row['lokasi'],
                'kluster' => $row['kluster'],
                'kavling' => $row['kavling'],
                'tipe' => $row['tipe'],
                'spk' => $row['spk'],
                'ptb' => $row['ptb'],
                'harga_deal' => $row['harga_deal'],
                'progres' => $row['progres'],
                'sales' => $row['sales'],
            ]);
        }
    }
}