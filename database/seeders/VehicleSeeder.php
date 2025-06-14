<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = [
            ['name' => 'Truk Tambang A', 'type' => 'angkutan barang', 'ownership' => 'milik', 'plate_number' => 'AB1234TA'],
            ['name' => 'Truk Tambang B', 'type' => 'angkutan barang', 'ownership' => 'sewa',  'plate_number' => 'AB1235TB'],
            ['name' => 'Mobil Operasional C', 'type' => 'angkutan orang', 'ownership' => 'milik', 'plate_number' => 'AB1236OC'],
            ['name' => 'Minibus D', 'type' => 'angkutan orang', 'ownership' => 'sewa', 'plate_number' => 'AB1237MD'],
            ['name' => 'Truk Tambang E', 'type' => 'angkutan barang', 'ownership' => 'milik', 'plate_number' => 'AB1238TE'],
            ['name' => 'Mobil Staff F', 'type' => 'angkutan orang', 'ownership' => 'sewa', 'plate_number' => 'AB1239SF'],
            ['name' => 'Truk Tambang G', 'type' => 'angkutan barang', 'ownership' => 'sewa', 'plate_number' => 'AB1240TG'],
            ['name' => 'Bus Karyawan H', 'type' => 'angkutan orang', 'ownership' => 'milik', 'plate_number' => 'AB1241BK'],
            ['name' => 'Truk Tambang I', 'type' => 'angkutan barang', 'ownership' => 'milik', 'plate_number' => 'AB1242TI'],
            ['name' => 'Minibus J', 'type' => 'angkutan orang', 'ownership' => 'sewa', 'plate_number' => 'AB1243MJ'],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}
